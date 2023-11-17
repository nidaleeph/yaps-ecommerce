<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Events; // 


class ProductController extends Controller
{
    public function index()
    {
        $query = Product::query()
            ->orderByRaw('quantity > 0 desc')
            ->orderBy('updated_at', 'desc');

        return $this->renderProducts($query);

    }

    public function byCategory(Category $category)
    {
        $categories = Category::getAllChildrenByParent($category);

        $query = Product::query()
            ->select('products.*')
            ->join('product_categories AS pc', 'pc.product_id', 'products.id')
            ->orderByRaw('quantity > 0 desc')
            ->orderBy('updated_at', 'desc')
            ->whereIn('pc.category_id', array_map(fn($c) => $c->id, $categories));

        return $this->renderProducts($query);
    }

    public function view(Product $product)
    {
        $existingActiveEvent = Events::where('active', 1)->first();
        return view('product.view', ['product' => $product, 'activeEvent' => $existingActiveEvent]);
    }

    private function renderProducts(Builder $query)
    {
        $search = \request()->get('search');
        $sort = \request()->get('sort', '-updated_at');

        if ($sort) {
            $sortDirection = 'asc';
            if ($sort[0] === '-') {
                $sortDirection = 'desc';
            }
            $sortField = preg_replace('/^-?/', '', $sort);

            $query->orderBy($sortField, $sortDirection);
        }
        $products = $query
            ->where('published', '=', 1)
            ->where(function ($query) use ($search) {
                /** @var $query \Illuminate\Database\Eloquent\Builder */
                $query->where('products.title', 'like', "%$search%")
                    ->orWhere('products.description', 'like', "%$search%")
                    ->orWhere('products.product_code', 'like', "%$search%");
            })

            ->paginate(10);

        $existingActiveEvent = Events::where('active', 1)->first();

        return view('product.index', [
            'products' => $products,
            'activeEvent' => $existingActiveEvent
        ]);

    }
}
