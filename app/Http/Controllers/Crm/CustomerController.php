<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Crm\Customer\StoreRequest;
use App\Http\Requests\Crm\Note\SaveRequest;
use App\Http\Resources\Crm\CustomerResource;
use App\Http\Resources\Crm\NoteResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $customer = $user->customers()->create($data);
        return $this->success('Müşteri başarıyla eklendi', CustomerResource::make($customer));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): CustomerResource
    {
        return CustomerResource::make($customer);
    }

    public function addNote(Customer $customer, SaveRequest $request): JsonResponse
    {
        $note = $customer->addNote($request->content, $request->title);
        return $this->success('Not başarıyla eklendi', NoteResource::make($note));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer): JsonResponse
    {
        $data = $request->validated();
        $customer->update($data);
        return $this->success('Müşteri bilgileri güncellendi.', CustomerResource::make($customer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();
        return $this->success('Müşteri başarıyla silindi.');
    }
}
