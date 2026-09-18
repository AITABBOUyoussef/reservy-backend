<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\TableResto;

class TablEtablissement
{
     public function AddTabl(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['etablissement_id']);
        $gerant_id=auth()->id();
   if($etablissement->gerant_id === $gerant_id){
        $tabl = new TableResto();
        $tabl->etablissement_id = $data['etablissement_id'];
        $tabl->numero = $data['numero'];
        $tabl->capacite = $data['capacite'];
        $tabl->save();

        return [
            'tabl' => $tabl,
        ];}
    }
       public function EditTabl(array $data)
    {
        $gerant_id=auth()->id();
        $etablissement = Etablissement::findOrFail($data['etablissement_id']);
         $tabl = TableResto::findOrFail($data['IdTabl']);

   if($etablissement->gerant_id === $gerant_id){
        $tabl->update([
            'etablissement_id' => $data['etablissement_id'],
        'numero' => $data['numero'],
        'capacite' => $data['capacite']
        ]);


        return [
            'tabl' => $tabl,
        ];}


    }

    public function daleteTabl(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $tabl = TableResto::findOrFail($data['IdTabl']);

        if($etablissement->gerant_id === $data['gerant_id']){
            $tabl->delete();
        }
    }
}
