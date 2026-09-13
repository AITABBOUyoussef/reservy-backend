<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TablEtablissementRequests extends FormRequest
{
    public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
    return [

        'etablissement_id'  => ['required', 'integer', 'exists:etablissements,id'],
        'numero'     => ['required', 'string', 'max:255'],
        'capacite' =>  ['required', 'integer'],
    ];
}

public function messages(): array
{
    return [

    ];
}
}
