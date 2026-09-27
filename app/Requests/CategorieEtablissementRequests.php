<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategorieEtablissementRequests extends FormRequest
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
            'etablissement_id'  => ['required', 'integer', 'exists:etablissements,id'],
            'nom'         => [
                'required',
                'string',
                'max:255',
// Traite la logique de la route ou du rappel.
                Rule::unique('categories')->where(function ($query) {
                    return $query->where('etablissement_id', $this->etablissement_id);
                })
            ]
        ];
    }
}
