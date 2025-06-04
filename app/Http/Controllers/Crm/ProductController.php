<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Crm\Product\StoreRequest;
use App\Http\Requests\Crm\Product\UpdateRequest;
use App\Http\Resources\Crm\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $product = $user->products()->create($data);
        return $this->success('Ürün başarıyla oluşturuldu.', ProductResource::make($product));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
    {
        $this->authorize('view', $product);
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product): JsonResponse
    {
        $this->authorize('update', $product);
        $data = $request->validated();
        $product->update($data);
        return $this->success('Ürün başarıyla güncellendi.', ProductResource::make($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);
        $product->delete();
        return $this->success('Ürün başarıyla silindi.');
    }
}
