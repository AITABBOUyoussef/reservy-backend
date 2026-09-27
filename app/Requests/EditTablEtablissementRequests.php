<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTablEtablissementRequests extends FormRequest
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
                'max:255'
            ],
            'IdTabl'  => ['required', 'integer', 'exists:table_restos,id'],

            'capacite' => ['required', 'integer'],
        ];
    }
}
