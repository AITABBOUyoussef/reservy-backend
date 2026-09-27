<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitOptionRequests extends FormRequest
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
            'nom_option' => ['required', 'string', 'max:255'],
            'prix_supplementaire' => ['required', 'numeric', 'min:0'],
        ];
    }
}
