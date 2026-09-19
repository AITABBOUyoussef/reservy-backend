<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProduitImageRequests extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'IdProduit' => ['required', 'integer', 'exists:produits,id'],
            'IdImage' => ['required', 'integer', 'exists:produit_images,id'],
        ];
    }
}
