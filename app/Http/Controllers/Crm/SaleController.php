<?php

namespace App\Http\Controllers\Crm;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Sale\StoreRequest;
use App\Http\Resources\Crm\SaleResource;

class SaleController extends Controller
{

    public function store(StoreRequest $request): SaleResource
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {

            $sale = Sale::create([
                'user_id' => $data['user_id'],
                'total' => $data['total'],
                'total_discount' => $data['total_discount'] ?? 0,
                'status' => $data['status'] ?? 'pending',
            ]);

            $sale->items()->createMany($data['items']);

            return SaleResource::make($sale->load('items'));
        });
    }

    /**
     * Tek satış göster
     */
    public function show(Sale $sale)
    {
        return new SaleResource($sale->load('items'));
    }
}
