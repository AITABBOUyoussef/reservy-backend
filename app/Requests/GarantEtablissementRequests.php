<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GarantEtablissementRequests extends FormRequest
{
 public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
    return [
      
        'etablissementId'  => ['required', 'integer', 'exists:etablissements,id'],

    ];
}

public function messages(): array
{
    return [

    ];
}
}
