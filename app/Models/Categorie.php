<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    protected $fillable = ['nom'];

// Ex?cute l?op?ration ? produits ?.
    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
// Ex?cute l?op?ration ? etablissements ?.
    public function etablissements()
    {
        return $this->belongsTo(Etablissement::class);
    }
}
