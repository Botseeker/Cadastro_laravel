<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' 
            .($user ? $user->id : null),
            'password' => 'required_if:password,!=,null|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            // 'name.required' => "Nome obrigatório!",
            'email.required' => "Campo e-mail obrigatório!",
            'email.email' => "Enviar um e-mail obrigatório!",
            'email.unique' => "O e-mail já está cadastrado!",
            'password.required_if' => "Campo senha obrigatório!",
            'password.min' => "Senha com no mínimo :min caracteres!",
        ];
    }
}
