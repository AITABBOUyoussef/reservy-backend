<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
  public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
'token'=>['required'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
    public function messages(): array
    {
        return [
            'email.required'                 => 'L\'adresse e-mail est obligatoire.',
            'email.email'                    => 'Veuillez saisir une adresse e-mail valide.',
            'email.unique'                   => 'Cette adresse e-mail est déjà associée à un compte.',

            'password.required'              => 'Le mot de passe est obligatoire.',
            'password.min'                   => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'             => 'La confirmation du mot de passe ne correspond pas.',

            'password_confirmation.required' => 'Veuillez confirmer votre mot de passe.',
        ];
    }
}
