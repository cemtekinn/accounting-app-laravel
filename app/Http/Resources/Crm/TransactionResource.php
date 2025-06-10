<?php

namespace App\Http\Resources\Crm;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'amount' => $this->amount,
            'description' => $this->description,
            'category' => $this->category,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
