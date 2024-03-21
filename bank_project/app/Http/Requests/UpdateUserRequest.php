<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->id === $this->route('id');
    }

    //isso é como se fosse o zod
    public function rules(): array
    {
        return [
            'name' => ['sometimes'],
            'email' => ['sometimes', 'email'],
            'password' => [
                'sometimes',
                'min:7', 'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/\d/'
            ],
        ];
    }

    //personalizar a mensagem de erro
    public function messages(): array
    {
        return [
            'email.email' => 'O e-mail deve ser um endereço válido',
            'password.min' => 'A senha deve ter no mínimo 7 caracteres',
            'password.regex' => 'A senha deve conter letras maiúsculas, minúsculas, números e caracteres especiais',
        ];
    }
}
