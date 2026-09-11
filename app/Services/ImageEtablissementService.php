<?php
namespace App\Services;

use App\Models\Etablissement;
use App\Models\EtablissementImage;
use Illuminate\Http\UploadedFile;
use phpseclib4\Crypt\AES;

class ImageEtablissementService
{
    public function AddImage(array $data)
    {
       $etablissement = Etablissement::findOrFail($data['etablissement_id']);

        $image = new EtablissementImage();

         if ($etablissement) {

            $file = $data['nom_image'];
            $fileName = time() . '.' . $file->extension();

            $file->move(public_path('photos'), $fileName);

            $image->nom_image = $fileName;
        }

        $image->etablissement_id = $data['etablissement_id']; // Affecter l'ID, pas l'objet
        $image->est_principale = $data['est_principale'];

         $image->save();

        return [
            'image' => $image,
        ];
    }

    public function daleteImage(array $data)
    {
     $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
     $image = EtablissementImage::findOrFail($data['IdImage']);
        if($etablissement->gerant_id===$data['gerant_id']){
      $image->delete();
        }
    }
}
