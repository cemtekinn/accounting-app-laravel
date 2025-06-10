<?php

namespace App\Http\Requests\Crm\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|string',
            'amount' => 'required',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori alanı zorunludur.',
            'category_id.exists' => 'Seçilen kategori mevcut değil.',
            'type.required' => 'Tür alanı zorunludur.',
            'type.string' => 'Tür alanı metin olmalıdır.',
            'amount.required' => 'Tutar alanı zorunludur.',
            'description.string' => 'Açıklama alanı metin olmalıdır.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'category_id' => 'Kategori',
            'type' => 'Tür',
            'amount' => 'Tutar',
            'description' => 'Açıklama',
        ];
    }
}
