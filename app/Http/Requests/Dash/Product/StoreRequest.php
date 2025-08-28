<?php

namespace App\Http\Requests\Dash\Product;

use App\Enums\CategoryType;
use App\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'stock_code' => ['nullable', 'string', 'max:255'],
            'barcode' => ['nullable', 'string', 'max:255'],
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:products,name,NULL,id,user_id,' . $this->user()->id,
            ],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'unit_id' => ['required', 'exists:units,id'],
            'status' => ['required', Rule::in(ProductStatus::cases())],
            'expiry_date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori alanı zorunludur.',
            'stock_code.required' => 'Stok kodu alanı zorunludur.',
            'name.required' => 'Ürün adı alanı zorunludur.',
            'price.required' => 'Fiyat alanı zorunludur.',
            'stock.required' => 'Stok miktarı alanı zorunludur.',
            'unit_id.required' => 'Birim alanı zorunludur.',
            'status.required' => 'Ürün durumu alanı zorunludur.',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'Kategori',
            'stock_code' => 'Stok kodu',
            'barcode' => 'Barkod',
            'name' => 'Ürün adı',
            'description' => 'Açıklama',
            'price' => 'Fiyat',
            'stock' => 'Stok miktarı',
            'unit_id' => 'Birim',
            'status' => 'Ürün durumu',
            'expiry_date' => 'Son kullanma tarihi',
        ];
    }

}

