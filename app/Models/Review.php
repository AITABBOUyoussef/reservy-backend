<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'etablissement_id',
        'client_id',
        'note',
        'commentaire',
    ];

// Ex?cute l?op?ration ? client ?.
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

// Ex?cute l?op?ration ? etablissement ?.
    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(Etablissement::class);
    }
}
