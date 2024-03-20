<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //isso é como se fosse o zod
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required', 'min:7', 'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/\d/'
            ],
            'cpf' => ['required', 'min:7', 'regex:/^[0-9]+$/'],
        ];
    }

    //personalizar a mensagem de erro
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'O e-mail deve ser um endereço válido',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo 7 caracteres',
            'password.regex' => 'A senha deve conter letras maiúsculas, minúsculas, números e caracteres especiais',
            'cpf.required' => 'O CPF é obrigatório',
            'cpf.min' => 'O CPF deve ter no mínimo 7 caracteres',
            'cpf.regex' => 'O CPF dever ter somente números'
        ];
    }
}
