<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EtablissementImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_image',
        'est_principale',
        'etablissement_id',
    ];

 


    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(Etablissement::class);
    }

}
