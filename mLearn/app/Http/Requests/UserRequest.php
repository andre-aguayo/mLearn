<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'access_level' => 'required|in:pro,premium',
            'msisdn' => 'required|numeric',
            'password' => 'required|min_digits:4',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nome nao informado.',
            'name.regex' => 'Nome inválido.',
            'access_level.required' => 'Nivel de acesso nao informado.',
            'access_level.in' => 'Nivel de acesso invalido.',
            'msisdn.required' => 'telefone nao informado.',
            'msisdn.numeric' => 'Telefone deve ser um numero.',
            'password.required' => 'Senha nao informada.',
            'password.min_digits' => 'A senha deve conter ao menos 4 digitos.'
        ];
    }
}
