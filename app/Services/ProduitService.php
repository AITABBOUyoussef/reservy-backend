<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\Produit;

class ProduitService
{
    public function getProduits(int $etablissementId): array
    {
        $etablissement = Etablissement::findOrFail($etablissementId);

        return [
            'produits' => Produit::with(['categorie', 'produitOptions', 'produitImages'])
                ->where('etablissement_id', $etablissement->id)
                ->orderBy('nom')
                ->get(),
        ];
    }

    public function addProduit(array $data): array
    {
        $etablissement = Etablissement::findOrFail($data['etablissement_id']);
        $gerantId = auth()->id();

        if ($etablissement->gerant_id === $gerantId) {
            $produit = new Produit;
            $produit->etablissement_id = $data['etablissement_id'];
            $produit->categorie_id = $data['categorie_id'];
            $produit->nom = $data['nom'];
            $produit->description = $data['description'] ?? null;
            $produit->prix = $data['prix'];
            $produit->save();

            return [
                'produit' => $produit->load(['categorie', 'produitOptions', 'produitImages']),
            ];
        }

        return [];
    }

    public function editProduit(array $data): array
    {
        $etablissement = Etablissement::findOrFail($data['etablissement_id']);
        $produit = Produit::findOrFail($data['IdProduit']);
        $gerantId = auth()->id();

        if ($etablissement->gerant_id === $gerantId) {
            $produit->update([
                'etablissement_id' => $data['etablissement_id'],
                'categorie_id' => $data['categorie_id'],
                'nom' => $data['nom'],
                'description' => $data['description'] ?? null,
                'prix' => $data['prix'],
            ]);

            return [
                'produit' => $produit->refresh()->load(['categorie', 'produitOptions', 'produitImages']),
            ];
        }

        return [];
    }

    public function deleteProduit(array $data): void
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $produit = Produit::findOrFail($data['IdProduit']);
        $gerantId = auth()->id();

        if ($etablissement->gerant_id === $gerantId) {
            $produit->delete();
        }
    }
}
