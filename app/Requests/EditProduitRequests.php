<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProduitRequests extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
