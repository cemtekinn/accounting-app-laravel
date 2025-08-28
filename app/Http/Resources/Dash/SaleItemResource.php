<?php

namespace App\Http\Resources\Dash;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => ProductResource::make($this->whenLoaded('product')),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount_amount' => $this->discount_amount,
            'tax_amount' => $this->tax_amount,
        ];
    }
}
