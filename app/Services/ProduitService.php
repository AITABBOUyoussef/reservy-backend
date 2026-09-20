<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\Produit;
use Illuminate\Auth\Access\AuthorizationException;

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

        if ($etablissement->gerant_id !== $gerantId) {
            throw new AuthorizationException('Vous ne pouvez pas gérer cet établissement.');
        }

        $this->ensureCategoryBelongsToEstablishment($data['categorie_id'], $etablissement->id);

        $produit = Produit::create([
            'etablissement_id' => $etablissement->id,
            'categorie_id' => $data['categorie_id'],
            'nom' => $data['nom'],
            'description' => $data['description'] ?? null,
            'prix' => $data['prix'],
        ]);

        return [
            'produit' => $produit->load(['categorie', 'produitOptions', 'produitImages']),
        ];
    }

    public function editProduit(array $data): array
    {
        $etablissement = Etablissement::findOrFail($data['etablissement_id']);
        $produit = Produit::findOrFail($data['IdProduit']);
        $gerantId = auth()->id();

        if ($etablissement->gerant_id !== $gerantId || $produit->etablissement_id !== $etablissement->id) {
            throw new AuthorizationException('Vous ne pouvez pas modifier ce produit.');
        }

        $this->ensureCategoryBelongsToEstablishment($data['categorie_id'], $etablissement->id);

        $produit->update([
            'categorie_id' => $data['categorie_id'],
            'nom' => $data['nom'],
            'description' => $data['description'] ?? null,
            'prix' => $data['prix'],
        ]);

        return [
            'produit' => $produit->refresh()->load(['categorie', 'produitOptions', 'produitImages']),
        ];
    }

    public function deleteProduit(array $data): void
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $produit = Produit::findOrFail($data['IdProduit']);
        $gerantId = auth()->id();

        if ($etablissement->gerant_id !== $gerantId || $produit->etablissement_id !== $etablissement->id) {
            throw new AuthorizationException('Vous ne pouvez pas supprimer ce produit.');
        }

        $produit->delete();
    }

    private function ensureCategoryBelongsToEstablishment(int $categoryId, int $etablissementId): void
    {
        $categoryBelongsToEstablishment = \App\Models\Categorie::query()
            ->whereKey($categoryId)
            ->where('etablissement_id', $etablissementId)
            ->exists();

        if (! $categoryBelongsToEstablishment) {
            throw new AuthorizationException('Cette catégorie n’appartient pas à cet établissement.');
        }
    }
}
