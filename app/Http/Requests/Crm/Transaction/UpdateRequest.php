<?php

namespace App\Http\Requests\Crm\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'category_id' => 'sometimes|integer|exists:categories,id',
            'type' => 'sometimes|string',
            'amount' => 'sometimes|numeric|min:0',
            'description' => 'sometimes|string',
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
            'category_id.integer' => 'Kategori ID bir tam sayı olmalıdır.',
            'category_id.exists' => 'Seçilen kategori mevcut değil.',
            'type.string' => 'Tür alanı metin olmalıdır.',
            'amount.numeric' => 'Tutar sayısal bir değer olmalıdır.',
            'amount.min' => 'Tutar en az 0 olmalıdır.',
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
