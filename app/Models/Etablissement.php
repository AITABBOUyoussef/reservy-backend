<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $fillable = [
        'gerant_id',
        'nom',
        'description',
        'adresse',
        'ville',
        'telephone',
        'est_valide',
    ];
}
