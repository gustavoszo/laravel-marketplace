<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'=> 'required',
            'description'=> 'required|min:10',
            'phone'=> 'required',
            'mobile_phone'=> 'required',
            'logo'=> 'image',
        ];
    }

    public function messages()
    {

        return [
            'required'=> 'Este campo é obrigatório',
            'min'=> 'O campo deve ter no mínimo :min caracteres',
            'image'=> 'O arquivo deve conter uma imagem válida',
        ];

    }

}
