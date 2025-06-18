<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Crm\Unit\StoreRequest;
use App\Http\Requests\Crm\Unit\UpdateRequest;
use App\Http\Resources\Crm\UnitResource;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = $request->input('per_page') ?? 10;
        $units = Unit::query()
            ->where(
                fn($u) => $u->where('user_id', $request->user()->id)
                    ->orWhereNull('user_id'))
            ->paginate($per_page);

        return UnitResource::collection($units);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $unit = $user->units()->create($data);
        return $this->success('Birim başarıyla eklendi', UnitResource::make($unit));
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit): UnitResource
    {
        $this->authorize('view', $unit);
        return UnitResource::make($unit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Unit $unit): JsonResponse
    {
        $this->authorize('update', $unit);

        $data = $request->validated();
        $unit->update($data);
        return $this->success('Birim başarıyla güncellendi', UnitResource::make($unit));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit): JsonResponse
    {
        $this->authorize('delete', $unit);
        $unit->delete();
        return $this->success('Birim başarıyla silindi');
    }
}
