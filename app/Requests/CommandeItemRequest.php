<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
