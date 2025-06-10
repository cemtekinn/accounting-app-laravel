<?php

namespace App\Http\Requests\Crm\Supplier;

use App\Enums\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string|max:255|unique:suppliers,name,' . $this->route('supplier')->id . ',id,user_id,' . $this->user()->id,
            'company_name' => 'nullable|string',
            'tax_number' => 'nullable|string',
            'tax_office' => 'nullable|string',
            'iban' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'currency' => ['nullable', 'string', Rule::in(Currency::cases())],
        ];
    }

    public function attributes()
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
            'name.required' => 'Tedarikçi adı alanı zorunludur.',
            'name.string' => 'Tedarikçi adı metin olmalıdır.',
            'name.max' => 'Tedarikçi adı en fazla 255 karakter olabilir.',
            'name.unique' => 'Bu tedarikçi adı zaten kullanılıyor.',
            'company_name.string' => 'Şirket adı metin olmalıdır.',
            'tax_number.string' => 'Vergi numarası metin olmalıdır.',
            'tax_office.string' => 'Vergi dairesi metin olmalıdır.',
            'iban.string' => 'IBAN metin olmalıdır.',
            'bank_name.string' => 'Banka adı metin olmalıdır.',
            'currency.string' => 'Döviz tipi metin olmalıdır.',
            'currency.in' => 'Seçilen döviz tipi geçersiz.',
        ];
    }
}
