<?php

namespace App\Requests;

class GoogleLoginRequest extends
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
