<?php

namespace App\Services;

use App\Models\Etablissement;

class CreeEtablissementService
{
     public function CreeEtablissement(array $data)
{
   $etablissement = Etablissement::create([
            'gerant_id'     => $data['gerant_id'],
            'nom'    => $data['nom'],
            'description'    => $data['description'],
            'adresse'    => $data['adresse'],
            'ville'    => $data['ville'],
            'telephone'    => $data['telephone'],
            'est_valide'    => $data['est_valide'],

        ]);
         return [
            'etablissement'  => $etablissement,

        ];

}
}
