<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'phone' => 'required|string|min:10|max:15',
            'cnh_number' => [
                'required',
                'digits:11',
                'unique:drivers,cnh_number'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'cnh_number.digits' => 'A CNH deve conter exatamente 11 dígitos numéricos',
            'cnh_number.unique' => 'Este número de CNH já está cadastrado.'
        ];
    }
}
