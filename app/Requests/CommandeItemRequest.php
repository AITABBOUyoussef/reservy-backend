<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeItemRequest extends FormRequest
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

            'reservation_id' => ['nullable', 'exists:reservations,id'],
            'produit_id' => ['required', 'integer', 'exists:produits,id'],
            'quantite' => ['required', 'integer', 'min:1'],
            'instructions_speciales' => ['nullable', 'string'],
        ];
    }
}
