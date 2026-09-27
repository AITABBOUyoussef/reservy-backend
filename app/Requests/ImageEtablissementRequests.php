<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageEtablissementRequests extends FormRequest
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
            'est_principale'     => ['required', 'boolean', 'max:255'],
            'nom_image' =>  ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

// Ex?cute l?op?ration ? messages ?.
    public function messages(): array
    {
        return [];
    }
}
