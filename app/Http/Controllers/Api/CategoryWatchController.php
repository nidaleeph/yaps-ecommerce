<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryWatchRequest;
use App\Http\Requests\UpdateCategoryWatchRequest;
use App\Http\Resources\CategoryWatchResource;
use App\Http\Resources\CategoryWatchTreeResource;
use App\Models\CategoryWatch;


class CategoryWatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');
        $perPage = request('per_page', 10);
        $search = request('search', '');

        $categoriesWatch = CategoryWatch::query()
        ->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->orderBy($sortField, $sortDirection)
            // ->latest()
            ->paginate($perPage);

        return CategoryWatchResource::collection($categoriesWatch);
    }

    public function getAsTree()
    {
        return CategoryWatch::getActiveAsTree(CategoryWatchTreeResource::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryWatchRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        $categoryWatch = CategoryWatch::create($data);

        return new CategoryWatchResource($categoryWatch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryWatchRequest $request, CategoryWatch $categoryWatch)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;
        $categoryWatch->update($data);

        return new CategoryWatchResource($categoryWatch);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryWatch $categoryWatch)
    {
        $categoryWatch->delete();

        return response()->noContent();
    }

    public function categoryWithAll(CategoryWatch $categoryWatch)
    {
        $categoriesWatch = CategoryWatch::select('id', 'name')
            ->get();

        // Add the 'all' and 'All CategoryWatch' row with both 'id' and 'name'
        $allCategoryWatch = new CategoryWatch();
        $allCategoryWatch->id = 0;
        $allCategoryWatch->name = 'All Watch Category';

        $categoriesWatch->prepend($allCategoryWatch);

        return $categoriesWatch;
    }

}
