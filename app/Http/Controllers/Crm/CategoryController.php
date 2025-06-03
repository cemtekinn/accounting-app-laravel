<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Crm\Category\StoreRequest;
use App\Http\Requests\Crm\Category\UpdateRequest;
use App\Http\Resources\Crm\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CategoryController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $category = $user->categories()->create([
            ...$data,
            'name' => Str::title($data['name'])
        ]);
        return $this->success('Kategori başarıyla eklendi', CategoryResource::make($category));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category): JsonResponse
    {
        $data = $request->validated();
        $category->update($data);
        return $this->success('Kategori başarıyla güncellendi', CategoryResource::make($category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->success('Kategori başarıyla silindi');
    }
}
