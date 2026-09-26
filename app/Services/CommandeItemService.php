<?php

namespace App\Services;

use App\Models\CommandeItem;
use App\Models\Produit;
use App\Models\Reservation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CommandeItemService
{
    public function createCommandeItem(array $data): CommandeItem
    {
        $user = auth()->user();
        $reservation = null;

        if (! empty($data['reservation_id'])) {
            $reservation = Reservation::with('etablissement')
                ->findOrFail($data['reservation_id']);

            $canManageReservation = $user->hasRole('admin')
                || (int) $reservation->client_id === (int) $user->id
                || ($user->hasRole('gerant')
                    && (int) $reservation->etablissement?->gerant_id === (int) $user->id);

            if (! $canManageReservation) {
                throw new AuthorizationException(
                    'Vous ne pouvez pas ajouter un produit à cette réservation.'
                );
            }
        }

        $produit = Produit::findOrFail($data['produit_id']);

        // Ila kayna réservation, produit khaso ykoun mn nefs établissement.
        if ($reservation
            && (int) $produit->etablissement_id !== (int) $reservation->etablissement_id) {
            throw ValidationException::withMessages([
                'produit_id' => 'Ce produit n’appartient pas à l’établissement de la réservation.',
            ]);
        }

        return CommandeItem::create([
            'client_id' => $reservation?->client_id ?? $user->id,
            'reservation_id' => $reservation?->id,
            'produit_id' => $produit->id,
            'quantite' => $data['quantite'],
            'prix_unitaire' => ($produit->prix)*($data['quantite']),
            'instructions_speciales' => $data['instructions_speciales'] ?? null,
        ])->load('produit');
    }
    public function getCommande(){
$id = auth()->id();
 $Command = DB::table('commande_items')
    ->join('produits','commande_items.produit_id','=',"produits.id")
    ->leftJoin('reservations','commande_items.reservation_id','=',"reservations.id")
    ->where([
        ['commande_items.client_id',$id]

    ])
    ->select(
        'commande_items.id',
        'produits.nom',
        'reservations.table_id',
        'reservations.nombre_personnes',
        'commande_items.quantite',
        'commande_items.prix_unitaire',
        'commande_items.instructions_speciales'
    )

    ->get();
     return [
        'commande_items' => $Command,
    ];
    }

}
