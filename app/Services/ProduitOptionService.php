<?php

namespace App\Services;

use App\Models\Produit;
use App\Models\ProduitOption;

class ProduitOptionService
{
  public function store(array $data){
       $produit = Produit::with('etablissement')->findOrFail($data['produit_id']);
       if($produit->etablissement && $produit->etablissement->gerant_id ===  auth()->id()){

       }
   $option =  ProduitOption::create([
'produit_id' => $data['produit_id'],
'nom_option' =>$data['nom_option'],
'prix_supplementaire' =>$data['prix_supplementaire'],
    ]);
    return ([
        'option' => $option,
    ]);
  }
}
