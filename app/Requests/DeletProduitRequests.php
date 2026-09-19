<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletProduitRequests extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'IdEtablissement' => ['required', 'integer', 'exists:etablissements,id'],
            'IdProduit' => ['required', 'integer', 'exists:produits,id'],
        ];
    }
}
