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
            'gerant_id'     => auth()->id(),
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
$Etablissement = Etablissement::with(['images' => function ($query) {
    $query->where('est_principale', 1);
}])->get();

     return [
            'Etablissement'  => $Etablissement,
        ];
}
public function getEtablissementGarant(array $data){


    $etablissement = Etablissement::with([
        'images',
        'tables',
        'categories:id,etablissement_id,nom',
        'produits.categorie:id,nom',
        'produits.produitOptions',
        'produits.produitImages',
        'reviews.client:id,name',
    ])
    ->withAvg('reviews as note_moyenne', 'note')
    ->where('gerant_id', $data['gerant_id'])
    ->get();




        return [
            'etablissements' => $etablissement,
            'msg'=>'Welecom'
        ];
}
public function getEtablissement(){

    $etablissements = DB::table('etablissements')
    ->join('etablissement_images','etablissements.id','=',"etablissement_images.etablissement_id")
    ->leftJoin('reviews','etablissements.id','=',"reviews.etablissement_id") // <-- HNA TBDEL: leftJoin f blast join
    ->where([
        ['etablissements.statut','acceptee'],
        ['etablissement_images.est_principale' , 1]
    ])
    ->select(
        'etablissements.id',
        'etablissements.nom',
        'etablissements.description',
        'etablissements.ville',
        'etablissement_images.nom_image',
        'etablissement_images.est_principale',
        DB::raw('AVG(reviews.note) as note_moyenne')
    )
    ->groupBy(
        'etablissements.id',
        'etablissements.nom',
        'etablissements.description',
        'etablissements.ville',
        'etablissement_images.nom_image',
        'etablissement_images.est_principale'
    )
    ->get();

    return [
        'etablissements' => $etablissements,
    ];
}
public function getEtablissementDettt(array $data){
$etablissementId = $data['etablissementId'];

// $etablissements = DB::select("
//     SELECT
//         etablissements.gerant_id,
//         etablissements.nom,
//         etablissements.description,
//         etablissements.adresse,
//         etablissements.ville,
//         etablissements.telephone,
//         etablissement_images.nom_image,
//         etablissement_images.est_principale,
//         table_restos.numero,
//         table_restos.capacite,
//         AVG(reviews.note) AS note_moyenne,
//         produits.nom AS produit_nom,
//         produits.description AS produit_description,
//         produits.prix,
//         produit_options.nom_option,
//         produit_options.prix_supplementaire,
//         produit_images.nom_image AS produit_image,
//         produit_images.est_principale AS produit_image_principale,
//         categories.nom AS categorie_nom,
//         reviews.commentaire,
//         reviews.client_id,
//         users.name
//     FROM `etablissements`
//     LEFT JOIN `etablissement_images` ON etablissements.id = etablissement_images.etablissement_id
//     LEFT JOIN `table_restos` ON etablissements.id = table_restos.etablissement_id
//     LEFT JOIN `reviews` ON etablissements.id = reviews.etablissement_id
//     LEFT JOIN `produits` ON etablissements.id = produits.etablissement_id
//     LEFT JOIN `categories` ON produits.categorie_id = categories.id
//     LEFT JOIN `produit_options` ON produits.id = produit_options.produit_id
//     LEFT JOIN `produit_images` ON produits.id = produit_images.produit_id
//     LEFT JOIN `users` ON users.id = reviews.client_id
//     WHERE etablissements.id = :etablissement_id
//     GROUP BY
//         etablissements.gerant_id,
//         etablissements.nom,
//         etablissements.description,
//         etablissements.adresse,
//         etablissements.ville,
//         etablissements.telephone,
//         etablissement_images.nom_image,
//         etablissement_images.est_principale,
//         table_restos.numero,
//         table_restos.capacite,
//         produits.nom,
//         produits.description,
//         produits.prix,
//         produit_options.nom_option,
//         produit_options.prix_supplementaire,
//         produit_images.nom_image,
//         produit_images.est_principale,
//         categories.nom,
//         reviews.commentaire,
//         reviews.client_id,
//         users.name
// ", [
//     'etablissement_id' => $etablissementId
// ]);
$etablissements = Etablissement::with(['images', 'tables', 'produits', 'reviews'])->find($etablissementId);
    return [
        'etablissements' =>$etablissements,
    ];
}
public function getEtablissementDet(array $data)
    {
        $etablissement = Etablissement::with([
            'images',
            'tables',
            'produits.categorie',
            'produits.produitOptions',
            'produits.produitImages',
            'reviews.client:id,name'
        ])
        ->withAvg('reviews as note_moyenne', 'note')
        ->findOrFail($data['etablissementId']);

        return [
            'etablissements' => $etablissement
        ];
    }


public function AcceptEtablissement(array $data){
$etablissement = Etablissement::findOrFail($data['IdEtablissement']);
$IDAdmin = auth()->id();
$admin=User::findOrFail($IDAdmin);
 $etablissement->update([
             'statut' => $data['statut'],
       ]);
if($data['statut'] === 'acceptee'){
       $user=User::findOrFail($data['gerant_id']);

      $role= $admin->getRoleNames()->first();
if($role==="admin"){
       $user->removeRole('client');
        $user->assignRole('gerant');}}
          return [
            'etablissement'  => $etablissement,
            'user'=>$user,
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

      $etablissement->delete();



    }

}
