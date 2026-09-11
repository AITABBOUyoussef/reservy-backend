<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    
    public function tables(): HasMany
    {
        return $this->hasMany(TableResto::class);
    }
}
