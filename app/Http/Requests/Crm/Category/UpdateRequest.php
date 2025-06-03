<?php

namespace App\Http\Requests\CRM\Category;

use App\Enums\CategoryType;
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
            'name' => 'required|string|max:255|unique:categories,name,' . $this->route('category')->id . ',id,user_id,' . $this->user()->id,
            'description' => 'nullable|string',
            'status' => 'boolean',
            'type' => ['required', 'string', Rule::in(CategoryType::cases())],
        ];
    }
}
