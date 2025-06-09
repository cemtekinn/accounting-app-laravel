<?php

namespace App\Http\Requests\Crm\Customer;

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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'İsim alanı zorunludur.',
            'first_name.string' => 'İsim alanı metin olmalıdır.',
            'first_name.max' => 'İsim en fazla 255 karakter olabilir.',
            'last_name.required' => 'Soyisim alanı zorunludur.',
            'last_name.string' => 'Soyisim alanı metin olmalıdır.',
            'last_name.max' => 'Soyisim en fazla 255 karakter olabilir.',
            'phone.required' => 'Telefon numarası alanı zorunludur.',
            'phone.string' => 'Telefon numarası metin olmalıdır.',
            'phone.max' => 'Telefon numarası en fazla 15 karakter olabilir.',
            'email.string' => 'E-posta metin olmalıdır.',
            'email.max' => 'E-posta en fazla 255 karakter olabilir.',
            'address.string' => 'Adres metin olmalıdır.',
            'address.max' => 'Adres en fazla 500 karakter olabilir.',
            'city.string' => 'Şehir metin olmalıdır.',
            'city.max' => 'Şehir en fazla 255 karakter olabilir.',
            'district.string' => 'İlçe metin olmalıdır.',
            'district.max' => 'İlçe en fazla 255 karakter olabilir.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'İsim',
            'last_name' => 'Soyisim',
            'phone' => 'Telefon numarası',
            'email' => 'E-posta',
            'address' => 'Adres',
            'city' => 'Şehir',
            'district' => 'İlçe',
        ];
    }
}
