<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ReservationRequests extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'etablissement_id' => ['required', 'integer', 'exists:etablissements,id'],
            'client_id' => ['sometimes', 'integer', 'exists:users,id'],
            'table_id' => ['nullable', 'integer', 'exists:table_restos,id'],
            'date_reservation' => ['required', 'date', 'after_or_equal:today'],
            'heure_reservation' => ['required', 'date_format:H:i'],
            'nombre_personnes' => ['required', 'integer', 'min:1'],
            'montant_total' => ['sometimes', 'numeric', 'min:0'],
            'statut_paiement' => ['sometimes', 'string', 'in:en_attente,paye_en_ligne,paye_sur_place'],
            'statut' => ['sometimes', 'string', 'in:en_attente,acceptee,refusee,terminee'],
        ];
    }

    public function messages(): array
    {
        return [
            'etablissement_id.required' => 'L’établissement est obligatoire.',
            'etablissement_id.exists' => 'L’établissement sélectionné n’existe pas.',
            'table_id.integer' => 'La table doit être valide.',
            'date_reservation.after_or_equal' => 'La date de réservation doit être aujourd\'hui ou dans le futur.',
            'date_reservation.required' => 'La date de réservation est obligatoire.',
            'heure_reservation.required' => 'L’heure de réservation est obligatoire.',
            'heure_reservation.date_format' => 'L’heure doit être au format HH:MM.',
            'nombre_personnes.min' => 'La réservation doit être pour au moins une personne.',
            'nombre_personnes.required' => 'Le nombre de personnes est obligatoire.',
            'nombre_personnes.integer' => 'Le nombre de personnes doit être un entier.',
            'table_id.exists' => 'La table sélectionnée n\'existe pas.',
        ];
    }
}
