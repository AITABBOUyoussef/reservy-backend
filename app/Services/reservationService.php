<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\Reservation;
use App\Models\TableResto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

class ReservationService
{
    public function getReservations(): array
    {
        $user = auth()->user();

       $query = Reservation::with([
    'client',
    'table',
    'commandeItems',
    'etablissement.images' => function ($query) {
        $query->where('est_principale', 1);
    }
]);

        if ($user->hasRole('gerant')) {
            $query->whereHas('etablissement', function ($q) use ($user) {
                $q->where('gerant_id', $user->id);
            });
        } elseif (! $user->hasRole('admin')) {
            $query->where('client_id', $user->id);
        }

        return [
            'reservations' => $query
                ->orderByDesc('date_reservation')
                ->orderByDesc('heure_reservation')
                ->get(),
        ];
    }

    public function createReservation(array $data): array
    {
        Etablissement::findOrFail($data['etablissement_id']);

        if (! empty($data['table_id'])) {
            $table = TableResto::findOrFail($data['table_id']);

            if ($table->etablissement_id !== $data['etablissement_id']) {
                throw ValidationException::withMessages([
                    'table_id' => 'Cette table n’appartient pas à cet établissement.',
                ]);
            }

            if ($table->capacite < $data['nombre_personnes']) {
                throw ValidationException::withMessages([
                    'nombre_personnes' => 'Le nombre de personnes dépasse la capacité de la table.',
                ]);
            }

            $conflit = Reservation::where('table_id', $data['table_id'])
                ->whereDate('date_reservation', $data['date_reservation'])
                ->whereTime('heure_reservation', $data['heure_reservation'])
                ->whereIn('statut', ['en_attente', 'acceptee'])
                ->exists();

            if ($conflit) {
                throw ValidationException::withMessages([
                    'table_id' => 'Cette table est déjà réservée à cette date et cette heure.',
                ]);
            }
        }

        $reservation = Reservation::create([
            'client_id' => auth()->id(),
            'etablissement_id' => $data['etablissement_id'],
            'table_id' => $data['table_id'] ?? null,
            'date_reservation' => $data['date_reservation'],
            'heure_reservation' => $data['heure_reservation'],
            'nombre_personnes' => $data['nombre_personnes'],
            'statut' => 'en_attente',
            'statut_paiement' => 'en_attente',
            'montant_total' => $data['montant_total'] ?? 0,
        ]);

        return [
            'reservation' => $reservation->load([
                'client',
                'etablissement',
                'table',
                'commandeItems',
            ]),
        ];
    }

    public function getReservation(int $id): array
    {
        $reservation = Reservation::with([
            'client',
            'etablissement',
            'table',
            'commandeItems',
        ])->findOrFail($id);

        $user = auth()->user();

        $estAdmin = $user->hasRole('admin');
        $estClient =  $reservation->client_id === $user->id;
        $estGerant = $user->hasRole('gerant')
            &&  $reservation->etablissement?->gerant_id === $user->id;

        if (! $estAdmin && ! $estClient && ! $estGerant) {
            throw new AuthorizationException(
                'Vous ne pouvez pas consulter cette réservation.'
            );
        }

        return ['reservation' => $reservation];
    }

    public function updateReservation(int $id, array $data): array
    {
        $reservation = Reservation::with('etablissement')->findOrFail($id);
        $user = auth()->user();

        $estAdmin = $user->hasRole('admin');
        $estGerant = $user->hasRole('gerant')
            &&   $reservation->etablissement?->gerant_id ===   $user->id;
        $estClient =   $reservation->client_id ===   $user->id;

        if (! $estAdmin && ! $estGerant && ! $estClient) {
            throw new AuthorizationException(
                'Vous ne pouvez pas modifier cette réservation.'
            );
        }

        $modifications = [];

        foreach ([
            'etablissement_id',
            'table_id',
            'date_reservation',
            'heure_reservation',
            'nombre_personnes',
        ] as $champ) {
            if (array_key_exists($champ, $data)) {
                $modifications[$champ] = $data[$champ];
            }
        }

        if ($estAdmin || $estGerant) {
            foreach (['statut', 'statut_paiement', 'montant_total'] as $champ) {
                if (array_key_exists($champ, $data)) {
                    $modifications[$champ] = $data[$champ];
                }
            }
        }

        $etablissementId = $modifications['etablissement_id']
            ?? $reservation->etablissement_id;

        if ($estGerant) {
            $sonEtablissement = Etablissement::where('id', $etablissementId)
                ->where('gerant_id', $user->id)
                ->exists();

            if (! $sonEtablissement) {
                throw new AuthorizationException(
                    'Vous ne pouvez pas gérer cet établissement.'
                );
            }
        } elseif (! $estAdmin
            &&   $etablissementId !==   $reservation->etablissement_id) {
            throw new AuthorizationException(
                'Vous ne pouvez pas déplacer cette réservation.'
            );
        }

        Etablissement::findOrFail($etablissementId);

        $tableId = $modifications['table_id'] ?? $reservation->table_id;
        $date = $modifications['date_reservation'] ?? $reservation->date_reservation;
        $heure = $modifications['heure_reservation'] ?? $reservation->heure_reservation;
        $nombrePersonnes = $modifications['nombre_personnes']
            ?? $reservation->nombre_personnes;
        $statut = $modifications['statut'] ?? $reservation->statut;

        if ($tableId) {
            $table = TableResto::findOrFail($tableId);

            if (  $table->etablissement_id !==   $etablissementId) {
                throw ValidationException::withMessages([
                    'table_id' => 'Cette table n’appartient pas à cet établissement.',
                ]);
            }

            if ($table->capacite < $nombrePersonnes) {
                throw ValidationException::withMessages([
                    'nombre_personnes' => 'Le nombre de personnes dépasse la capacité de la table.',
                ]);
            }

            if (in_array($statut, ['en_attente', 'acceptee'])) {
                $conflit = Reservation::where('table_id', $tableId)
                    ->whereDate('date_reservation', $date)
                    ->whereTime('heure_reservation', $heure)
                    ->whereIn('statut', ['en_attente', 'acceptee'])
                    ->where('id', '!=', $reservation->id)
                    ->exists();

                if ($conflit) {
                    throw ValidationException::withMessages([
                        'table_id' => 'Cette table est déjà réservée à cette date et cette heure.',
                    ]);
                }
            }
        }

        $reservation->update($modifications);

        return [
            'reservation' => $reservation->refresh()->load([
                'client',
                'etablissement',
                'table',
                'commandeItems',
            ]),
        ];
    }

    public function deleteReservation(int $id): void
    {
        $reservation = Reservation::with('etablissement')->findOrFail($id);
        $user = auth()->user();

        $estAdmin = $user->hasRole('admin');
        $estClient =   $reservation->client_id ===   $user->id;
        $estGerant = $user->hasRole('gerant')
            &&  $reservation->etablissement?->gerant_id ===   $user->id;

        if (! $estAdmin && ! $estClient && ! $estGerant) {
            throw new AuthorizationException(
                'Vous ne pouvez pas supprimer cette réservation.'
            );
        }

        $reservation->delete();
    }
}
