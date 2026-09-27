<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreeEtablissementRequest extends FormRequest
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

            'nom'         => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'adresse'     => ['required', 'string', 'max:255'],
            'ville'       => ['required', 'string', 'max:100'],
            'telephone'   => ['required', 'string', 'max:20'],

        ];
    }

// Ex?cute l?op?ration ? messages ?.
    public function messages(): array
    {
        return [
            'nom.required'         => 'Le nom est obligatoire.',
            'nom.string'           => 'Le nom doit être une chaîne de caractères.',
            'nom.max'              => 'Le nom ne peut pas dépasser :max caractères.',

            'description.string'   => 'La description doit être une chaîne de caractères.',

            'adresse.required'     => 'L\'adresse est obligatoire.',
            'adresse.string'       => 'L\'adresse doit être une chaîne de caractères.',
            'adresse.max'          => 'L\'adresse ne peut pas dépasser :max caractères.',

            'ville.required'       => 'La ville est obligatoire.',
            'ville.string'         => 'La ville doit être une chaîne de caractères.',
            'ville.max'            => 'La ville ne peut pas dépasser :max caractères.',

            'telephone.required'   => 'Le numéro de téléphone est obligatoire.',
            'telephone.string'     => 'Le numéro de téléphone doit être valide.',
            'telephone.max'        => 'Le numéro de téléphone ne peut pas dépasser :max caractères.',



        ];
    }
}
