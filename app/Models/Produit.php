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
        'prix'
    ];

// Ex?cute l?op?ration ? etablissement ?.
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id');
    }

// Ex?cute l?op?ration ? etablissements ?.
    public function etablissements()
    {
        return $this->etablissement();
    }
// Ex?cute l?op?ration ? categorie ?.
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
// Ex?cute l?op?ration ? produitImages ?.
    public function produitImages()
    {
        return $this->hasMany(ProduitImage::class);
    }
// Ex?cute l?op?ration ? commandeItems ?.
    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class);
    }
// Ex?cute l?op?ration ? produitOptions ?.
    public function produitOptions()
    {
        return $this->hasMany(ProduitOption::class);
    }
}
