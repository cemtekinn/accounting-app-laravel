<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Dash\Transaction\StoreRequest;
use App\Http\Requests\Dash\Transaction\UpdateRequest;
use App\Http\Resources\Dash\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = $request->input('per_page', 10);

        $modelQuery = $request->user()->transactions();
        $transactions = QueryBuilder::for($modelQuery)
            ->allowedFilters('type', 'category_id')
            ->paginate($per_page);

        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $transaction = $user->transactions()->create($data);
        return $this->success('Hesap hareketi başarıyla eklendi', TransactionResource::make($transaction));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction): TransactionResource
    {
        $this->authorize('view', $transaction);
        $transaction->load('category');
        return TransactionResource::make($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Transaction $transaction): JsonResponse
    {
        $this->authorize('update', $transaction);
        $data = $request->validated();
        $transaction->update($data);
        return $this->success('Hesap hareketi başarıyla güncellendi', TransactionResource::make($transaction));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $this->authorize('delete', $transaction);
        $transaction->delete();
        $this->success('Hesap hareketi başarıyla silindi');
    }
}
