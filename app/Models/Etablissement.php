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


    public function images(): HasMany
    {
        return $this->hasMany(EtablissementImage::class);
    }
public function users(): BelongsTo
{
    return $this->belongsTo(User::class);
}

    public function tables(): HasMany
    {
        return $this->hasMany(TableResto::class);
    }

public function produits(): HasMany
{
    return $this->hasMany(Produit::class);
}
public function categories(): HasMany
{
    return $this->hasMany(Categorie::class);
}

public function reviews(): HasMany
{
    return $this->hasMany(Review::class);
}

public function reservations(): HasMany
{
    return $this->hasMany(Reservation::class);
}
}
