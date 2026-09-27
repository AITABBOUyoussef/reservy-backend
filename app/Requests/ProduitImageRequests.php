<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitImageRequests extends FormRequest
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
            'produit_id' => ['required', 'integer', 'exists:produits,id'],
            'est_principale' => ['required', 'boolean'],
            'nom_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
