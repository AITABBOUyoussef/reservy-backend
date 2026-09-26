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

        'IdEtablissement'  => ['required', 'integer', 'exists:etablissements,id'],
        'statut'     => ['required', 'string', 'in:acceptee,refusee'],
        'gerant_id' =>  ['required', 'integer', 'exists:users,id'],
    ];
}

public function messages(): array
{
    return [
        'IdEtablissement.required' => 'L’établissement est obligatoire.',
        'IdEtablissement.exists' => 'L’établissement sélectionné n’existe pas.',
        'statut.required' => 'Le statut est obligatoire.',
        'statut.in' => 'Le statut doit être accepté ou refusé.',
        'gerant_id.required' => 'Le gérant est obligatoire.',
        'gerant_id.exists' => 'Le gérant sélectionné n’existe pas.',
    ];
}
}
