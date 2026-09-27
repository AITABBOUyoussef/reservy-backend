<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
    protected $fillable = [
        'client_id',
        'reservation_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'instructions_speciales'
    ];

// Ex?cute l?op?ration ? reservation ?.
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

// Ex?cute l?op?ration ? produit ?.
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
