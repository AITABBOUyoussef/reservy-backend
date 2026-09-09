<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptEtablissementRequest extends FormRequest
{

    public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
    return [
        'roleUSer'   => ['required', 'string', 'exists:users,id'],
        'IdEtablissement'  => ['required', 'integer', 'exists:etablissements,id'],
        'statut'     => ['required', 'string', 'max:255'],
        // 'gerant_id' =>  ['required', 'integer', 'exists:users,id'],
    ];
}

public function messages(): array
{
    return [

    ];
}
}
