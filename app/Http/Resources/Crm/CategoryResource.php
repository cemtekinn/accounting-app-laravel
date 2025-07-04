<?php

namespace App\Http\Resources\Crm;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "status" => $this->status,
            "type" => $this->type,
            "created_at" => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
