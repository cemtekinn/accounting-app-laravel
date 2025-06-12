<?php

namespace App\Http\Resources\Crm;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total' => $this->total,
            'total_discount' => $this->total_discount,
            'status' => $this->status,
            'created_at' => $this->created_at?->format('d-m-Y H:i:s'),
            'items' => SaleItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
