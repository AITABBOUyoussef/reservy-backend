<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
      'etablissement_id',
      'categorie_id',
      'nom',
      'description',
      'prix'];

     public function etablissement () {
 return $this->belongsTo(Etablissement::class, 'etablissement_id');
     }

     public function etablissements () {
 return $this->etablissement();
     }
     public function categorie (){
        return $this->belongsTo(Categorie::class);
     }
     public function produitImages(){
        return $this->hasMany(ProduitImage::class);
     }
     public function commandeItems(){
        return $this->hasMany(CommandeItem::class);
     }
      public function produitOptions(){
        return $this->hasMany(ProduitOption::class);
      }
}
