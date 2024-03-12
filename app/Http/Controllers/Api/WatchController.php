<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WatchRequest;
use App\Http\Resources\WatchListResource;
use App\Http\Resources\WatchResource;
use App\Models\Api\Watch;
use App\Models\WatchCategory;
use App\Models\WatchImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Helpers\GlobalHelpers;
use App\Models\Category;


class WatchController extends Controller
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

        $query = Watch::query();
        if( $category != 0){
            $query->orWhereHas('categoriesWatch', function ($query) use ($category) {
                $query->where('watch_categories.category_watch_id', $category);
            });
        }
        $query = $query->where(function ($query) use ($search) {
            $query->where('watches.title', 'like', '%' . $search . '%')
                ->orWhere('watches.watch_code', 'like', '%' . $search . '%');
        })

        // ->with('categoriesWatch')
        ->orderBy($sortField, $sortDirection)
        ->paginate($perPage);

        return WatchListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(WatchRequest $request)
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

        $watch = Watch::create($data);


        $this->saveCategories($categories, $watch);
        $this->saveImages($images, $imagePositions, $watch);

        return new WatchResource($watch);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Watch $watch
     * @return \Illuminate\Http\Response
     */
    public function show(Watch $watch)
    {
        return new WatchResource($watch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Watch      $watch
     * @return \Illuminate\Http\Response
     */
    public function update(WatchRequest $request, Watch $watch)
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

        $this->saveCategories($categories, $watch);
        $this->saveImages($images, $imagePositions, $watch);
        if (count($deletedImages) > 0) {
            $this->deleteImages($deletedImages, $watch);
        }

        $watch->update($data);

        return new WatchResource($watch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Watch $watch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watch $watch)
    {
        $watch->delete();

        return response()->noContent();
    }

    private function saveCategories($categoryIds, Watch $watch)
    {
        WatchCategory::where('watch_id', $watch->id)->delete();
        $data = array_map(fn($id) => (['category_watch_id' => $id, 'watch_id' => $watch->id]), $categoryIds);

        WatchCategory::insert($data);
    }

    /**
     *
     *
     * @param UploadedFile[] $images
     * @return string
     * @throws \Exception
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     */
    private function saveImages($images, $positions, Watch $watch)
    {
        foreach ($positions as $id => $position) {
            WatchImage::query()
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

            WatchImage::create([
                'watch_id' => $watch->id,
                'path' => $relativePath,
                'url' => URL::to(Storage::url($relativePath)),
                'mime' => $image->getClientMimeType(),
                'size' => $image->getSize(),
                'position' => $positions[$id] ?? $id + 1
            ]);
        }
    }

    private function deleteImages($imageIds, Watch $watch)
    {
        $images = WatchImage::query()
            ->where('watch_id', $watch->id)
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
        return Watch::withTrashed()->count();
    }

    public function downloadWatchCategoryCsv(Request $request, $id, Watch $watch) {

        $query = Watch::select([
            'watches.watch_code',
            'watches.title',
            'watches.price',
            'watches.quantity',
            'categories.name as category_name',
        ])
        ->join('watch_categories', 'watches.id', '=', 'watch_categories.watch_id')
        ->join('categories', 'watch_categories.category_watch_id', '=', 'categories.id')
        ->where('watches.quantity', '>', 0)
        ->orderBy('categories.id', 'ASC')
        ->when($id != 0, function ($query) use ($id) {
            $query->where('categories.id', $id);
        })
        ->orderBy('watches.id', 'ASC') // Add this line to order by watches.id
        ->get();


        $data = [];

        foreach ($query as $item) {
            array_push($data, [
                $item->watch_code,
                $item->title,
                $item->price,
                $item->quantity,
                $item->category_name,
            ]);

        }

        $headers = [[
            'Watch Code',
            'Watch Name',
            'Price',
            'Quantity',
            'Category',
        ]];

        $path = GlobalHelpers::generateCsv([
            'header' => $headers,
            'data' => $data,
            'filename' => 'Watchs-category='.$id. '.csv',
            'path' => '/exports/watches/csv/',
        ]);

        $fileName = 'Watchs-category='.$id . '.csv';

        $path = storage_path('app/exports/watches/csv/'.$fileName);

        $response = response()->download($path, $fileName);

        return $response;

    }

}
