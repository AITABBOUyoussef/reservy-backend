<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


}
