<?php

namespace App\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class LoginRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    return [
        'email'=>['required','email'],
        'password' => ['required','string'],
    ];
  }
  #[Override]
  public function messages()
  {
    return [
            'email.required'    => 'L\'adresse email est obligatoire.',
            'email.email'       => 'Veuillez saisir une adresse email valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ];
  }
}
