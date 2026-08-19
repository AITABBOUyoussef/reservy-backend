<?php

namespace App\Requests;
use Illuminate\Foundation\Http\FormRequest;

class InscriptionRequest extends FormRequest
{
     public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    return [
        'name'=> ['required'],
        'email'=>['required','email'],
        'password' => ['required','string'],
        'password_confirmation' => ['required','string'],
    ];
  }
 public function messages(): array
    {
        return [
            'name.required'                  => 'Le nom complet est obligatoire.',
            'name.max'                       => 'Le nom ne peut pas dépasser 255 caractères.',

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
