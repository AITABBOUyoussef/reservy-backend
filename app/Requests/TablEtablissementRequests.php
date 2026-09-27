<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class TablEtablissementRequests extends FormRequest
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
            'etablissement_id' => ['required', 'integer', 'exists:etablissements,id'],

            'numero' => [
                'required',
                'integer',
                'max:255',
// Traite la logique de la route ou du rappel.
                Rule::unique('table_restos')->where(function ($query) {
                    return $query->where('etablissement_id', $this->etablissement_id);
                })
            ],

            'capacite' => ['required', 'integer'],
        ];
    }

// Ex?cute l?op?ration ? messages ?.
    public function messages(): array
    {
        return [
            'numero.unique' => 'Ce numéro de table existe déjà dans cet établissement.',
            'numero.required' => 'Le numéro de table est obligatoire.',
            'capacite.required' => 'La capacité de la table est obligatoire.',
        ];
    }
}
