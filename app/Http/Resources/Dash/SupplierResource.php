<?php

namespace App\Http\Resources\Dash;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'company_name' => $this->company_name,
            'tax_number' => $this->tax_number,
            'tax_office' => $this->tax_office,
            'iban' => $this->iban,
            'bank_name' => $this->bank_name,
            'status' => $this->status,
            'currency' => $this->currency,
            'contacts' => $this->whenLoaded('contacts', function () {
                SupplierContactResource::collection($this->contacts);
            }),
            'created_at' => $this->created_at?->format('d-m-Y H:i:s')
        ];
    }
}
