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

        $image->etablissement_id = $data['etablissement_id'];
        $image->est_principale = $data['est_principale'];

         $image->save();

        return [
            'image' => $image,
        ];
    }
public function EditImage(array $data) {
    $etablissement = Etablissement::findOrFail($data['IdEtablissement']);

    if ($etablissement->gerant_id != $data['gerant_id']) {
        return response()->json(['message' => 'Non autorisé'], 403);
    }

    $image = EtablissementImage::findOrFail($data['IdImage']);

     if ($image->etablissement_id != $etablissement->id) {
        return response()->json(['message' => 'Cette image n\'appartient pas à cet établissement'], 403);
    }

    EtablissementImage::where('etablissement_id', $etablissement->id)
                      ->update(['est_principale' => 0]);

    $image->update([
        'est_principale' => 1,
    ]);

  
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
