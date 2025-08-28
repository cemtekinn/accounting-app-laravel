<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Dash\Customer\StoreRequest;
use App\Http\Requests\Dash\Customer\UpdateRequest;
use App\Http\Requests\Dash\Note\SaveRequest;
use App\Http\Resources\Dash\CustomerResource;
use App\Http\Resources\Dash\NoteResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class CustomerController extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $modelQuery = $request->user()->customers();
        $per_page = $request->input('per_page', 10);

        $customers = QueryBuilder::for($modelQuery)
            ->allowedFilters('status')
            ->paginate($per_page);

        return CustomerResource::collection($customers);
    }

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
        $this->authorize('view', $customer);
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Customer $customer): JsonResponse
    {
        $this->authorize('update', $customer);
        $data = $request->validated();
        $customer->update($data);
        return $this->success('Müşteri bilgileri güncellendi.', CustomerResource::make($customer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $this->authorize('delete', $customer);
        $customer->delete();
        return $this->success('Müşteri başarıyla silindi.');
    }

    public function addNote(Customer $customer, SaveRequest $request): JsonResponse
    {
        $data = $request->validated();
        $note = $customer->addNote($data['content'], $data['title']);
        return $this->success('Not başarıyla eklendi', NoteResource::make($note));
    }

    public function notes(Customer $customer, Request $request): AnonymousResourceCollection
    {
        $per_page = $request->input('per_page', 10);
        $notes = $customer->notes()->paginate($per_page);
        return NoteResource::collection($notes);
    }
}
