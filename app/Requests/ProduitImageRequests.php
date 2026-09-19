<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitImageRequests extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'produit_id' => ['required', 'integer', 'exists:produits,id'],
            'est_principale' => ['required', 'boolean'],
            'nom_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
