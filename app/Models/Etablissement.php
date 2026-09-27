<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etablissement extends Model
{
    protected $fillable = [
        'gerant_id',
        'nom',
        'description',
        'adresse',
        'ville',
        'telephone',
        'statut',
    ];


// Ex?cute l?op?ration ? images ?.
    public function images(): HasMany
    {
        return $this->hasMany(EtablissementImage::class);
    }
// Ex?cute l?op?ration ? users ?.
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

// Ex?cute l?op?ration ? tables ?.
    public function tables(): HasMany
    {
        return $this->hasMany(TableResto::class);
    }

// Ex?cute l?op?ration ? produits ?.
    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
// Ex?cute l?op?ration ? categories ?.
    public function categories(): HasMany
    {
        return $this->hasMany(Categorie::class);
    }

// Ex?cute l?op?ration ? reviews ?.
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

// Ex?cute l?op?ration ? reservations ?.
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
