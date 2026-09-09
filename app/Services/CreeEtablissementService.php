<?php

namespace App\Services;

use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;

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
            'statut'    => 'en_attente',

        ]);
         return [
            'etablissement'  => $etablissement,

        ];

}
public function EtablissementAttente(){
    $Etablissement_en_attente = DB::table('etablissements')
    ->where('statut',"en_attente")
    ->first();
     return [
            'Etablissement_en_attente'  => $Etablissement_en_attente,
        ];
}
public function AcceptEtablissement(array $data){
$etablissement = Etablissement::find($data['IdEtablissement']);
        $etablissement->updated([
             'statut' => $data['statut'],
       ]);
          return [
            'etablissement'  => $etablissement,

        ];

}

}
