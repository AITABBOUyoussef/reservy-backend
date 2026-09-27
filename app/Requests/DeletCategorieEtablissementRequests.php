<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletCategorieEtablissementRequests extends FormRequest
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
            'IdCategorie'  => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
