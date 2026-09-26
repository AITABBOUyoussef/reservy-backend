<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\EtablissementImage;
use Cloudinary\Cloudinary;

class ImageEtablissementService
{
    private function cloudinary()
    {
        return new Cloudinary(env('CLOUDINARY_URL'));
    }

    public function AddImage(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['etablissement_id']);

        // Upload l Cloudinary
        $uploaded = $this->cloudinary()->uploadApi()->upload($data['nom_image']->getRealPath(), [
            'folder' => 'reservy/etablissements'
        ]);

        // Ila kant principale, rdd lokhrin 0
        if (!empty($data['est_principale'])) {
            EtablissementImage::where('etablissement_id', $etablissement->id)->update(['est_principale' => 0]);
        }

        return EtablissementImage::create([
            'nom_image'        => $uploaded['secure_url'],
            'public_id'        => $uploaded['public_id'],
            'etablissement_id' => $etablissement->id,
            'est_principale'   => $data['est_principale'] ?? 0,
        ]);
    }

    public function EditImage(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $image = EtablissementImage::findOrFail($data['IdImage']);

        if ($etablissement->gerant_id == $data['gerant_id'] && $image->etablissement_id == $etablissement->id) {
            EtablissementImage::where('etablissement_id', $etablissement->id)->update(['est_principale' => 0]);
            $image->update(['est_principale' => 1]);
            return $image;
        }

        return false;
    }

    public function deleteImage(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $image = EtablissementImage::findOrFail($data['IdImage']);

        if ($etablissement->gerant_id == $data['gerant_id'] && $image->etablissement_id == $etablissement->id) {
            if ($image->public_id) {
                try {
                    $this->cloudinary()->uploadApi()->destroy($image->public_id);
                } catch (\Exception $e) {}
            }

            return $image->delete();
        }

        return false;
    }
}
