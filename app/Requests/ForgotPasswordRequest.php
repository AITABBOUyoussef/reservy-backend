<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{

 public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    return [
        'email'=>['required','email','exists:users,email'],
        ];
  }

  public function messages()
  {
    return [
          'email.exists' => 'Aucun compte ne correspond à cette adresse e-mail.'
        ];
  }

}
