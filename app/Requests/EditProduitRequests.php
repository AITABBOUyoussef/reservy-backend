<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProduitRequests extends FormRequest
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
            'IdProduit' => ['required', 'integer', 'exists:produits,id'],
            'etablissement_id' => ['required', 'integer', 'exists:etablissements,id'],
            'categorie_id' => ['required', 'integer', 'exists:categories,id'],
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'prix' => ['required', 'numeric', 'min:0'],
        ];
    }
}
