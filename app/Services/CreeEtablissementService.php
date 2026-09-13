<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\User;
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
public function getAllEtablissement(User $user){

if($user->getRoleNames()->first()=="admin")
   { $Etablissement = Etablissement::all();
     return [
            'Etablissement'  => $Etablissement,
        ];}
}
public function getEtablissement(){

    $etablissements = DB::table('etablissements')
    ->join('etablissement_images','etablissements.id','=',"etablissement_images.etablissement_id")
    ->join('reviews','etablissements.id','=',"reviews.etablissement_id")
    ->where([['etablissements.statut','acceptee'] , ['etablissement_images.est_principale' , 1]] )
    ->select('etablissements.id' , 'etablissements.nom' , 'etablissements.description' ,'etablissements.ville' , 'etablissement_images.nom_image' , 'etablissement_images.est_principale', DB::raw('AVG(reviews.note) as note_moyenne'))
    ->groupBy('etablissements.id' , 'etablissements.nom' , 'etablissements.description' ,'etablissements.ville' , 'etablissement_images.nom_image' , 'etablissement_images.est_principale')
    ->get();
    return [
        'etablissements' =>$etablissements,
    ];
}
public function AcceptEtablissement(array $data){
$etablissement = Etablissement::findOrFail($data['IdEtablissement']);
 $etablissement->update([
             'statut' => $data['statut'],
       ]);
if($data['statut'] === 'acceptee'){
       $user=User::findOrFail($data['gerant_id']);
      $role= $user->getRoleNames()->first();
       if(!$role==='admin'){
       $user->removeRole('client');
        $user->assignRole('gerant');}}
          return [
            'etablissement'  => $etablissement,
        ];

}
     public function EditEtablissement(array $data)
{
$etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        if($etablissement->gerant_id===$data['gerant_id']){
   $etablissement->update([

            'nom'    => $data['nom'],
            'description'    => $data['description'],
            'adresse'    => $data['adresse'],
            'ville'    => $data['ville'],
            'telephone'    => $data['telephone'],


        ]);
        }
         return [
            'etablissement'  => $etablissement,

        ];

}
    public function destroy(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        if($etablissement->gerant_id===$data['gerant_id']){
      $etablissement->delete();
        }


    }

}
