<?php

namespace App\Http\Requests\Dash\Category;

use App\Enums\CategoryType;
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
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,user_id,' . $this->user()->id,
            'description' => 'nullable|string',
            'status' => 'boolean',
            'type' => ['required', 'string', Rule::in(CategoryType::cases())],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => "Bu isimde bir kategori zaten var.",
            'type.in' => "Kategori tipi geçersiz."
        ];
    }
}
