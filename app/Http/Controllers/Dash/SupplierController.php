<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Dash\Supplier\StoreRequest;
use App\Http\Requests\Dash\Supplier\UpdateRequest;
use App\Http\Resources\Dash\NoteResource;
use App\Http\Resources\Dash\SupplierContactResource;
use App\Http\Resources\Dash\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Dash\Note\SaveRequest as NoteSaveRequest;
use App\Http\Requests\Dash\Supplier\Contact\SaveRequest as ContactSaveRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class SupplierController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = $request->input('per_page', 10);

        $modelQuery = $request->user()->suppliers();
        $suppliers = QueryBuilder::for($modelQuery)
            ->allowedFilters('name', 'status', 'company_name', 'currency')
            ->paginate($per_page);

        return SupplierResource::collection($suppliers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $supplier = $user->suppliers()->create($data);
        return $this->success('Tedarikçi başarıyla eklendi', SupplierResource::make($supplier));
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier): SupplierResource
    {
        $this->authorize('view', $supplier);
        return SupplierResource::make($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Supplier $supplier): JsonResponse
    {
        $this->authorize('update', $supplier);
        $data = $request->validated();
        $supplier->update($data);
        return $this->success('Tedarikçi başarıyla güncellendi', SupplierResource::make($supplier));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        $this->authorize('delete', $supplier);
        $supplier->delete();
        return $this->success('Tedarikçi başarıyla silindi');
    }

    public function addContact(ContactSaveRequest $request, Supplier $supplier): JsonResponse
    {
        $data = $request->validated();
        $contact = $supplier->contacts()->create($data);
        return $this->success('Tedarikçi iletişim bilgisi başarıyla eklendi', SupplierContactResource::make($contact));
    }

    public function addNote(NoteSaveRequest $request, Supplier $supplier): JsonResponse
    {
        $data = $request->validated();
        $note = $supplier->addNote($data['content'], $data['title']);
        return $this->success('Not başarıyla eklendi', NoteResource::make($note));
    }

    public function notes(Supplier $supplier, Request $request): AnonymousResourceCollection
    {
        $per_page = $request->input('per_page', 10);
        $notes = $supplier->notes()->paginate($per_page);
        return NoteResource::collection($notes);
    }

}
