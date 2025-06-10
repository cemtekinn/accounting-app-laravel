<?php

namespace App\Http\Requests\Crm\Supplier\Contact;

use App\Models\SupplierContact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveRequest extends FormRequest
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
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:1000',
            'position' => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'Ad',
            'last_name' => 'Soyad',
            'phone' => 'Telefon',
            'email' => 'E-posta',
            'address' => 'Adres',
            'position' => 'Pozisyon',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Ad alanı zorunludur.',
            'first_name.string' => 'Ad alanı metin olmalıdır.',
            'first_name.max' => 'Ad en fazla :max karakter olabilir.',

            'last_name.required' => 'Soyad alanı zorunludur.',
            'last_name.string' => 'Soyad alanı metin olmalıdır.',
            'last_name.max' => 'Soyad en fazla :max karakter olabilir.',

            'phone.required' => 'Telefon alanı zorunludur.',
            'phone.string' => 'Telefon alanı metin olmalıdır.',
            'phone.max' => 'Telefon en fazla :max karakter olabilir.',

            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.max' => 'E-posta en fazla :max karakter olabilir.',

            'address.string' => 'Adres alanı metin olmalıdır.',
            'address.max' => 'Adres en fazla :max karakter olabilir.',

            'position.string' => 'Pozisyon alanı metin olmalıdır.',
            'position.max' => 'Pozisyon en fazla :max karakter olabilir.',
        ];
    }

}
