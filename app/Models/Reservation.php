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


    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function table()
    {
        return $this->belongsTo(TableResto::class, 'table_id');
    }

    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class);
    }

}
