<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{

// V?rifie l?autorisation de l?action.
    public function authorize(): bool
    {
        return true;
    }
// D?finit les r?gles de validation et d?acc?s.
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
        ];
    }

// Ex?cute l?op?ration ? messages ?.
    public function messages()
    {
        return [
            'email.exists' => 'Aucun compte ne correspond à cette adresse e-mail.'
        ];
    }
}
