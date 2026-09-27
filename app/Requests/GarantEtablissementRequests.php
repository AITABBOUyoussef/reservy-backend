<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GarantEtablissementRequests extends FormRequest
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

            'etablissementId'  => ['required', 'integer', 'exists:etablissements,id'],

        ];
    }

// Ex?cute l?op?ration ? messages ?.
    public function messages(): array
    {
        return [];
    }
}
