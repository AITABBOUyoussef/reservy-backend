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

    public function messages(): array
    {
        return [
            'etablissement_id.exists' => 'L’établissement sélectionné n’existe pas.',
            'table_id.exists' => 'La table sélectionnée n’existe pas.',
            'date_reservation.after_or_equal' => 'La date doit être aujourd’hui ou dans le futur.',
            'heure_reservation.date_format' => 'L’heure doit être au format HH:MM.',
            'nombre_personnes.min' => 'La réservation doit être pour au moins une personne.',
        ];
    }
}
