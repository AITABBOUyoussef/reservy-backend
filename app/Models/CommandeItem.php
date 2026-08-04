<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
       protected $fillable = [
        'reservation_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'instructions_speciales'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
