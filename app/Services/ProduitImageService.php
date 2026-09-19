<?php

namespace App\Services;

use App\Models\Produit;
use App\Models\ProduitImage;
use Illuminate\Auth\Access\AuthorizationException;

class ProduitImageService
{
    public function addImage(array $data): array
    {
        $produit = Produit::with('etablissement')->findOrFail($data['produit_id']);
        $this->ensureOwner($produit);

        $file = $data['nom_image'];
        $fileName = time() . '_' . uniqid() . '.' . $file->extension();
        $file->move(public_path('photos'), $fileName);

        if ((bool) $data['est_principale']) {
            ProduitImage::where('produit_id', $produit->id)->update(['est_principale' => false]);
        }

        $image = ProduitImage::create([
            'produit_id' => $produit->id,
            'nom_image' => $fileName,
            'est_principale' => (bool) $data['est_principale'],
        ]);

        return ['image' => $image];
    }

    public function deleteImage(array $data): void
    {
        $produit = Produit::with('etablissement')->findOrFail($data['IdProduit']);
        $this->ensureOwner($produit);

        $image = ProduitImage::whereKey($data['IdImage'])
            ->where('produit_id', $produit->id)
            ->firstOrFail();

        $image->delete();
    }

    public function setMainImage(array $data): void
    {
        $produit = Produit::with('etablissement')->findOrFail($data['IdProduit']);
        $this->ensureOwner($produit);

        $image = ProduitImage::whereKey($data['IdImage'])
            ->where('produit_id', $produit->id)
            ->firstOrFail();

        ProduitImage::where('produit_id', $produit->id)
            ->update(['est_principale' => false]);
        $image->update(['est_principale' => true]);
    }

    private function ensureOwner(Produit $produit): void
    {
        if (! $produit->etablissement || (int) $produit->etablissement->gerant_id !== (int) auth()->id()) {
            throw new AuthorizationException('Vous ne pouvez pas gérer les images de ce produit.');
        }
    }
}
