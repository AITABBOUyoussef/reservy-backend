<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProduitImage extends Model
{
    protected $fillable = [
        'produit_id',
        'nom_image',
        'est_principale'
    ];

// Ex?cute l?op?ration ? produit ?.
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
