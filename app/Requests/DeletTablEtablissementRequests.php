<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletTablEtablissementRequests extends FormRequest
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
            'IdTabl'  => ['required', 'integer', 'exists:table_restos,id'],
        ];
    }
}
