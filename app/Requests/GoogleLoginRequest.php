<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoogleLoginRequest extends FormRequest
{
    /**
     * Create a new class instance.
     */
   public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    return [
        'token'=>['required']
    ];
  }
    public function messages()
  {
    return [
            'token.required'    => 'Token est obligatoire.',
        ];
  }
}
