<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Api\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Helpers\GlobalHelpers;
use App\Models\Category;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
        $category = request('category', 0); // Change this to the category ID you want to filter by
        
        $query = Product::query();
        if( $category != 0){
            $query = $query->orWhereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category);
            });
        }
        $query = $query->where(function ($query) use ($search) {
            $query->where('products.quantity', 'like', '%' . $search . '%')
                ->orWhere('products.title', 'like', '%' . $search . '%')
                ->orWhere('products.product_code', 'like', '%' . $search . '%')
                ->orWhere('products.price', 'like', '%' . $search . '%');
        })
            
        ->with('categories')
        ->orderBy($sortField, $sortDirection)
        ->paginate($perPage);

        return ProductListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile[] $images */
        $images = $data['images'] ?? [];
        $imagePositions = $data['image_positions'] ?? [];

        $categories = $data['categories'] ?? [];

        // Ensure $categories is an array
        if (!is_array($categories)) {
            // Convert it to an array with a single element
            $categories = [$categories];
        }

        $product = Product::create($data);

        $this->saveCategories($categories, $product);
        $this->saveImages($images, $imagePositions, $product);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product      $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile[] $images */
        $images = $data['images'] ?? [];
        $deletedImages = $data['deleted_images'] ?? [];
        $imagePositions = $data['image_positions'] ?? [];
        $categories = $data['categories'] ?? [];

        if (!is_array($categories)) {
            // Convert it to an array with a single element
            $categories = [$categories];
        }
        
        $this->saveCategories($categories, $product);
        $this->saveImages($images, $imagePositions, $product);
        if (count($deletedImages) > 0) {
            $this->deleteImages($deletedImages, $product);
        }

        $product->update($data);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }

    private function saveCategories($categoryIds, Product $product)
    {
        ProductCategory::where('product_id', $product->id)->delete();
        $data = array_map(fn($id) => (['category_id' => $id, 'product_id' => $product->id]), $categoryIds);

        ProductCategory::insert($data);
    }

    /**
     *
     *
     * @param UploadedFile[] $images
     * @return string
     * @throws \Exception
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     */
    private function saveImages($images, $positions, Product $product)
    {
        foreach ($positions as $id => $position) {
            ProductImage::query()
                ->where('id', $id)
                ->update(['position' => $position]);
        }

        foreach ($images as $id => $image) {
            $path = 'images/' . Str::random();
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path, 0755, true);
            }
            $name = Str::random().'.'.$image->getClientOriginalExtension();
            if (!Storage::putFileAS('public/' . $path, $image, $name)) {
                throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
            }
            $relativePath = $path . '/' . $name;

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $relativePath,
                'url' => URL::to(Storage::url($relativePath)),
                'mime' => $image->getClientMimeType(),
                'size' => $image->getSize(),
                'position' => $positions[$id] ?? $id + 1
            ]);
        }
    }

    private function deleteImages($imageIds, Product $product)
    {
        $images = ProductImage::query()
            ->where('product_id', $product->id)
            ->whereIn('id', $imageIds)
            ->get();

        foreach ($images as $image) {
            // If there is an old image, delete it
            if ($image->path) {
                Storage::deleteDirectory('/public/' . dirname($image->path));
            }
            $image->delete();
        }
    }

    public function getItemCount()
    {
        return Product::withTrashed()->count();
    }

    public function downloadProductCategoryCsv(Request $request, $id, Product $product) {

        $query = Product::select([
            'products.product_code',
            'products.title',
            'products.price',
            'products.quantity',
            'categories.name as category_name',
        ])
        ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
        ->join('categories', 'product_categories.category_id', '=', 'categories.id')
        ->where('products.quantity', '>', 0)
        ->orderBy('categories.id', 'ASC')
        ->when($id != 0, function ($query) use ($id) {
            $query->where('categories.id', $id);
        })
        ->orderBy('products.id', 'ASC') // Add this line to order by products.id
        ->get();


        $data = [];

        foreach ($query as $item) {
            array_push($data, [
                $item->product_code,
                $item->title,
                $item->price,
                $item->quantity,
                $item->category_name,
            ]);
    
        }

        $headers = [[
            'Product Code',
            'Product Name',
            'Price',
            'Quantity',
            'Category',
        ]];

        $path = GlobalHelpers::generateCsv([
            'header' => $headers,
            'data' => $data,
            'filename' => 'Products-category='.$id. '.csv',
            'path' => '/exports/products/csv/',
        ]);

        $fileName = 'Products-category='.$id . '.csv';

        $path = storage_path('app/exports/products/csv/'.$fileName);

        $response = response()->download($path, $fileName);

        return $response;
       
    }
    
}
