<?php

namespace App\Http\Requests\Customer;

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
            'contact_person' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,'.$this->route('customer')->id.',id,user_id,' . $this->user()->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:2000',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ];
    }
}
