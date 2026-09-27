<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProduitImageRequests extends FormRequest
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
            'IdImage' => ['required', 'integer', 'exists:produit_images,id'],
        ];
    }
}
