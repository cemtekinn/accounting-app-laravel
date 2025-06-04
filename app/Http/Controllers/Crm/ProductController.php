<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Crm\Product\StoreRequest;
use App\Http\Requests\Crm\Product\UpdateRequest;
use App\Http\Resources\Crm\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $product = Product::create($data);
        return $this->success('Ürün başarıyla oluşturuldu.', ProductResource::make($product));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();
        $product->update($data);
        return $this->success('Ürün başarıyla güncellendi.', ProductResource::make($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->success('Ürün başarıyla silindi.');
    }
}
