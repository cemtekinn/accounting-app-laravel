<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Crm\Supplier\StoreRequest;
use App\Http\Resources\Crm\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $supplier = $user->suppliers()->create($data);
        return $this->success('Tedarikçi başarıyla eklendi',SupplierResource::make($supplier));
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
