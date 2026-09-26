<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'etablissement_id' => ['sometimes', 'integer', 'exists:etablissements,id'],
            'table_id' => ['nullable', 'integer', 'exists:table_restos,id'],
            'date_reservation' => ['sometimes', 'date', 'after_or_equal:today'],
            'heure_reservation' => ['sometimes', 'date_format:H:i'],
            'nombre_personnes' => ['sometimes', 'integer', 'min:1'],
            'montant_total' => ['sometimes', 'numeric', 'min:0'],
            'statut_paiement' => ['sometimes', 'string', 'in:en_attente,paye_en_ligne,paye_sur_place'],
            'statut' => ['sometimes', 'string', 'in:en_attente,acceptee,refusee,terminee'],
        ];
    }
}
