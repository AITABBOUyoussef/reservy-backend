<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TableResto extends Model
{
    use HasFactory;

    protected $table = 'table_restos';

    protected $fillable = [
        'numero',
        'capacite',
        'etablissement_id',
    ];


    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(Etablissement::class);
    }
public function reservations(): HasMany
{
    return $this->hasMany(Reservation::class, 'table_id');
}

}
