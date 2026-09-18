<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\Categorie;
class CategorieEtablissementService
{
    public function addCategorie(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['etablissement_id']);

        $categorie = new Categorie();
        $categorie->etablissement_id = $data['etablissement_id'];
        $categorie->nom = $data['nom'];
        $categorie->save();

        return [
            'categorie' => $categorie,
        ];
    }

   
}
