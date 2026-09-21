<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitOptionRequests extends FormRequest
{
   public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'produit_id' => ['required', 'integer', 'exists:produits,id'],
            'nom_option' => ['required', 'string', 'max:255'],
            'prix_supplementaire' => ['required', 'numeric', 'min:0'],
        ];
    }
}
