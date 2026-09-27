<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptEtablissementRequest extends FormRequest
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

            'IdEtablissement'  => ['required', 'integer', 'exists:etablissements,id'],
            'statut'     => ['required', 'string', 'in:acceptee,refusee'],
            'gerant_id' =>  ['required', 'integer', 'exists:users,id'],
        ];
    }

// Ex?cute l?op?ration ? messages ?.
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
