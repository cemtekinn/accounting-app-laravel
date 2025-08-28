<?php

namespace App\Http\Requests\Dash\Supplier;

use App\Enums\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string|max:255|unique:suppliers,name,NULL,id,deleted_at,NULL,user_id,' . $this->user()->id,
            'company_name' => 'nullable|string',
            'tax_number' => 'nullable|string',
            'tax_office' => 'nullable|string',
            'iban' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'currency' => ['nullable', 'string', Rule::in(Currency::cases())],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tedarikçi Adı',
            'company_name' => 'Şirket Adı',
            'tax_number' => 'Vergi Numarası',
            'tax_office' => 'Vergi Dairesi',
            'iban' => 'IBAN',
            'bank_name' => 'Banka Adı',
            'currency' => 'Döviz Tipi',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tedarikçi Adı alanı zorunludur.',
            'name.string' => 'Tedarikçi Adı geçerli bir metin olmalıdır.',
            'name.max' => 'Tedarikçi Adı en fazla 255 karakter olabilir.',
            'name.unique' => 'Bu Tedarikçi Adı zaten kullanılmış.',
            'company_name.string' => 'Şirket Adı geçerli bir metin olmalıdır.',
            'tax_number.string' => 'Vergi Numarası geçerli bir metin olmalıdır.',
            'tax_office.string' => 'Vergi Dairesi geçerli bir metin olmalıdır.',
            'iban.string' => 'IBAN geçerli bir metin olmalıdır.',
            'bank_name.string' => 'Banka Adı geçerli bir metin olmalıdır.',
            'currency.string' => 'Döviz Tipi geçerli bir metin olmalıdır.',
            'currency.in' => 'Seçilen Döviz Tipi geçerli değil.',
        ];
    }

}
