<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Dash\Product\StoreRequest;
use App\Http\Requests\Dash\Product\UpdateRequest;
use App\Http\Resources\Dash\CustomerResource;
use App\Http\Resources\Dash\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $modelQuery = $request->user()->products();
        $per_page = $request->input('per_page', 10);

        $products = QueryBuilder::for($modelQuery)
            ->allowedFilters([
                'status',
                'category_id',
                'stock_code',
                'barcode',
                'name',
                'unit_id',
            ])
            ->allowedSorts([
                'price',
                'expiry_date',
                'stock',
                'name',
            ])
            ->paginate($per_page);

        return ProductResource::collection($products);
    }

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
