<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_id',
        'etablissement_id',
        'table_id',
        'date_reservation',
        'heure_reservation',
        'nombre_personnes',
        'montant_total',
        'statut_paiement',
        'statut'
    ];


// Ex?cute l?op?ration ? client ?.
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

// Ex?cute l?op?ration ? etablissement ?.
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

// Ex?cute l?op?ration ? table ?.
    public function table()
    {
        return $this->belongsTo(TableResto::class, 'table_id');
    }

// Ex?cute l?op?ration ? commandeItems ?.
    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class);
    }
}
