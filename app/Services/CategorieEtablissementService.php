<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\Categorie;

class CategorieEtablissementService
{
// Ex?cute l?op?ration ? addCategorie ?.
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
// Supprime une ressource.
    public function deleteCategorie(array $data)
    {
        $gerant_id = auth()->id();

        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $categorie = Categorie::findOrFail($data['IdCategorie']);

        if ($etablissement->gerant_id === $gerant_id) {
            $categorie->delete();
        }
    }
}
