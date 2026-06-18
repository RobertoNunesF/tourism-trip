<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'model' => 'required|string|min:2|max:255',
            'capacity' => 'required|integer|min:1|max:100',
            'plate' => [
                'required',
                'string',
                'unique:vehicles,plate',
                'regex:/^[A-Z]{3}[0-9][A-Z0-9][0-9]{2}$/i' //valida as duas formas de placas - Mercosul ou Antiga              
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'plate.regex' => 'O formato da placa não respeita o formato tradicional (ABC1234)',
            'plate.unique' => 'Esta placa já está cadastrada no sistema',
        ];
    }
}
