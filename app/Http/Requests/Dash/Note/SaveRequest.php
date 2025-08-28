<?php

namespace App\Http\Requests\Dash\Note;

use Illuminate\Foundation\Http\FormRequest;

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
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'title.string' => 'Başlık metin olmalıdır.',
            'title.max' => 'Başlık en fazla :max karakter olabilir.',
            'content.required' => 'İçerik alanı zorunludur.',
            'content.string' => 'İçerik metin olmalıdır.',
            'content.max' => 'İçerik en fazla :max karakter olabilir.',
        ];
    }

    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'title' => 'Başlık',
            'content' => 'İçerik',
        ];
    }
}
