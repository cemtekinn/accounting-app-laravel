<?php

    namespace App\Http\Requests\Crm\Unit;

    use Illuminate\Foundation\Http\FormRequest;

    class UpdateRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return true;
        }

        public function rules(): array
        {
            return [
                'name' => 'required|string|max:255|unique:units,name,' . $this->route('unit') . ',id,user_id,' . $this->user()->id,
                'short_name' => 'nullable|string|max:5',
            ];
        }

        public function messages(): array
        {
            return [
                'name.required' => 'Birim adı zorunludur.',
                'name.unique' => 'Bu isimde bir birim zaten var.',
                'name.max' => 'Birim adı en fazla 255 karakter olabilir.',
                'short_name.max' => 'Kısa ad en fazla 5 karakter olabilir.',
            ];
        }

        public function attributes(): array
        {
            return [
                'name' => 'Birim Adı',
                'short_name' => 'Kısa Ad',
            ];
        }
    }
