<?php

namespace App\Http\Requests\Dash\Sale;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'status' => 'nullable|string',

            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1|max:9999',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.discount_amount' => 'nullable|numeric|min:0',
            'items.*.tax_amount' => 'nullable|numeric|min:0',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'kullanıcı',
            'total' => 'toplam tutar',
            'discount' => 'indirim',
            'tax' => 'KDV',
            'status' => 'durum',

            'items' => 'ürün listesi',
            'items.*.product_id' => 'ürün',
            'items.*.quantity' => 'adet',
            'items.*.price' => 'fiyat',
            'items.*.discount_amount' => 'ürün indirimi',
            'items.*.tax_amount' => 'ürün KDV\'si',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Lütfen bir :attribute seçin.',
            'user_id.exists' => 'Seçilen :attribute geçerli değil.',
            'total.required' => ':attribute alanı zorunludur.',
            'total.numeric' => ':attribute bir sayı olmalıdır.',
            'total.min' => ':attribute en az 0 olmalıdır.',

            'items.required' => 'En az bir :attribute eklemelisiniz.',
            'items.array' => ':attribute doğru formatta değil.',
            'items.min' => ':attribute en az 1 adet olmalıdır.',

            'items.*.product_id.required' => 'Her ürün için bir :attribute seçin.',
            'items.*.product_id.exists' => 'Geçersiz :attribute seçtiniz.',
            'items.*.quantity.required' => ':attribute alanı zorunludur.',
            'items.*.quantity.integer' => ':attribute bir tam sayı olmalıdır.',
            'items.*.quantity.min' => ':attribute en az 1 olmalıdır.',
            'items.*.quantity.max' => ':attribute en fazla 9999 olabilir.',
            'items.*.price.required' => ':attribute alanı zorunludur.',
            'items.*.price.numeric' => ':attribute sayı olmalıdır.',
            'items.*.price.min' => ':attribute sıfırdan büyük olmalıdır.',
            'items.*.discount_amount.numeric' => ':attribute sayı olmalıdır.',
            'items.*.discount_amount.min' => ':attribute negatif olamaz.',
            'items.*.tax_amount.numeric' => ':attribute sayı olmalıdır.',
            'items.*.tax_amount.min' => ':attribute negatif olamaz.',
        ];
    }
}
