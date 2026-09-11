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
    ->where('statut','acceptee')
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
