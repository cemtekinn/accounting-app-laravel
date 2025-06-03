<?php

namespace App\Http\Requests\Supplier;

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
            'email' => 'nullable|string|email|max:255|unique:suppliers,email,' . $this->route('supplier')->id . ',id,user_id,' . $this->user()->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'iban' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'currency' => ['nullable', 'string', Rule::in(Currency::cases())],
            'status' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'contacts' => 'nullable|array',
            'contacts.*.id' => 'required_if:contacts,!=,null|integer',
            'contacts.*.contact_name' => 'required_if:contacts,!=,null|string|max:255',
            'contacts.*.contact_email' => 'nullable|email|max:255',
            'contacts.*.contact_phone' => 'nullable|string|max:20',
            'contacts.*.position' => 'nullable|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tedarikçi Adı',
            'company_name' => 'Şirket Adı',
            'tax_number' => 'Vergi Numarası',
            'tax_office' => 'Vergi Dairesi',
            'email' => 'E-Posta',
            'phone' => 'Telefon',
            'address' => 'Adres',
            'iban' => 'IBAN',
            'bank_name' => 'Banka Adı',
            'currency' => 'Döviz Tipi',
            'status' => 'Durum',
            'notes' => 'Notlar',
            'contacts' => 'İletişim Kişileri',
            'contacts.*.id' => 'Kişi ID',
            'contacts.*.contact_name' => 'Kişi Adı',
            'contacts.*.contact_email' => 'Kişi E-Postası',
            'contacts.*.contact_phone' => 'Kişi Telefonu',
            'contacts.*.position' => 'Kişi Pozisyonu',

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
            'email.string' => 'E-Posta metin olmalıdır.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.max' => 'E-Posta en fazla 255 karakter olabilir.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
            'phone.string' => 'Telefon metin olmalıdır.',
            'address.string' => 'Adres metin olmalıdır.',
            'iban.string' => 'IBAN metin olmalıdır.',
            'bank_name.string' => 'Banka adı metin olmalıdır.',
            'currency.string' => 'Döviz tipi metin olmalıdır.',
            'currency.in' => 'Seçilen döviz tipi geçersiz.',
            'status.boolean' => 'Durum alanı doğru veya yanlış olmalıdır.',
            'notes.string' => 'Notlar metin olmalıdır.',
            'contacts.array' => 'İletişim kişilerinin bir dizi olması gerekir.',
            'contacts.*.contact_name.required_if' => 'Kişi adı alanı zorunludur.',
            'contacts.*.contact_name.string' => 'Kişi adı metin olmalıdır.',
            'contacts.*.contact_name.max' => 'Kişi adı en fazla 255 karakter olabilir.',
            'contacts.*.contact_email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'contacts.*.contact_email.max' => 'Kişi e-postası en fazla 255 karakter olabilir.',
            'contacts.*.contact_phone.string' => 'Kişi telefonu metin olmalıdır.',
            'contacts.*.contact_phone.max' => 'Kişi telefonu en fazla 20 karakter olabilir.',
            'contacts.*.position.string' => 'Kişi pozisyonu metin olmalıdır.',
            'contacts.*.position.max' => 'Kişi pozisyonu en fazla 255 karakter olabilir.',
        ];
    }
}
