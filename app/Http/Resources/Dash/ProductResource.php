<?php

namespace App\Http\Resources\Dash;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category' => $this->whenLoaded('category', function () {
                return CategoryResource::make($this->category);
            }),
            'stock_code' => $this->stock_code,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'unit' => UnitResource::make($this->unit),
            'status' => $this->status,
            'expiry_date' => $this->expiry_date?->format('Y-m-d'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
