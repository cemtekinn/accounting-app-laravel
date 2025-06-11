<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Crm\Category\StoreRequest;
use App\Http\Requests\Crm\Category\UpdateRequest;
use App\Http\Resources\Crm\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = $request->input('per_page', 10);

        $modelQuery = $request->user()->categories();
        $categories = QueryBuilder::for($modelQuery)
            ->allowedFilters('type')
            ->paginate($per_page);

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $category = $user->categories()->create($data);
        return $this->success('Kategori başarıyla eklendi', CategoryResource::make($category));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryResource
    {
        $this->authorize('view', $category);
        return CategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category): JsonResponse
    {
        $this->authorize('update', $category);
        $data = $request->validated();
        $category->update($data);
        return $this->success('Kategori başarıyla güncellendi', CategoryResource::make($category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $this->authorize('delete', $category);
        $category->delete();
        return $this->success('Kategori başarıyla silindi');
    }
}
