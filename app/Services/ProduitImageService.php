<?php

namespace App\Services;

use App\Models\Produit;
use App\Models\ProduitImage;
use Cloudinary\Cloudinary;

class ProduitImageService
{
    private function cloudinary()
    {
        return new Cloudinary(env('CLOUDINARY_URL'));
    }

    public function addImage(array $data)
    {
        $produit = Produit::with('etablissement')->findOrFail($data['produit_id']);


        if ($produit->etablissement && $produit->etablissement->gerant_id ===  auth()->id()) {

          
            $uploaded = $this->cloudinary()->uploadApi()->upload($data['nom_image']->getRealPath(), [
                'folder' => 'reservy/produits',
            ]);


            if (!empty($data['est_principale'])) {
                ProduitImage::where('produit_id', $produit->id)->update(['est_principale' => false]);
            }

            $image = ProduitImage::create([
                'produit_id'     => $produit->id,
                'nom_image'      => $uploaded['secure_url'],
                'public_id'      => $uploaded['public_id'],
                'est_principale' =>  ($data['est_principale'] ?? false),
            ]);

            return ['image' => $image];
        }

        return false;
    }

    public function deleteImage(array $data)
    {
        $produit = Produit::with('etablissement')->findOrFail($data['IdProduit']);
        $image   = ProduitImage::whereKey($data['IdImage'])->where('produit_id', $produit->id)->first();

        // Verification d l-owner w l-image b if
        if ($produit->etablissement &&  $produit->etablissement->gerant_id ===  auth()->id() && $image) {

            // Mse7 mn Cloudinary ila kayn public_id
            if (!empty($image->public_id)) {
                try {
                    $this->cloudinary()->uploadApi()->destroy($image->public_id);
                } catch (\Exception $e) {}
            }

            return $image->delete();
        }

        return false;
    }

    public function setMainImage(array $data)
    {
        $produit = Produit::with('etablissement')->findOrFail($data['IdProduit']);
        $image   = ProduitImage::whereKey($data['IdImage'])->where('produit_id', $produit->id)->first();

        // Verification d l-owner w l-image b if
        if ($produit->etablissement &&  $produit->etablissement->gerant_id === auth()->id() && $image) {

            ProduitImage::where('produit_id', $produit->id)->update(['est_principale' => false]);
            $image->update(['est_principale' => true]);

            return $image;
        }

        return false;
    }
}
