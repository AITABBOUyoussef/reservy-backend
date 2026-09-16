<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEtablissementRequests extends FormRequest
{
public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
    return [
        'IdEtablissement'  => ['required', 'integer', 'exists:etablissements,id'],
        'gerant_id'   => ['required', 'integer', 'exists:users,id'],
        'nom'         => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'adresse'     => ['required', 'string', 'max:255'],
        'ville'       => ['required', 'string', 'max:100'],
        'telephone'   => ['required', 'string', 'max:20'],

    ];
}

public function messages(): array
{
    return [
        'gerant_id.required'   => 'L\'identifiant du gérant est obligatoire.',
        'gerant_id.integer'    => 'L\'identifiant du gérant doit être un entier.',
        'gerant_id.exists'     => 'Le gérant sélectionné n\'existe pas.',

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
