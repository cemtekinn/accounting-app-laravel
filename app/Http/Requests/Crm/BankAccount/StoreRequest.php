<?php

namespace App\Http\Requests\CRM\BankAccount;

use App\Enums\AccountType;
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
            'account_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'iban' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'account_number' => 'nullable|string|max:255',
            'opening_date' => 'nullable|date',
            'description' => 'nullable|max:2000',
            'account_type' => ['required', 'string', 'max:255', Rule::in(AccountType::cases())],
            'currency' => ['nullable', 'string', 'max:255', Rule::in(Currency::cases())],
        ];
    }
}
