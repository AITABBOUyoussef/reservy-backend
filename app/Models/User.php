<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'role_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
// Ex?cute l?op?ration ? role ?.
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
// Ex?cute l?op?ration ? etablissments ?.
    public function etablissments()
    {
        return $this->hasMany(Etablissement::class);
    }
// Ex?cute l?op?ration ? reviews ?.
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'client_id');
    }

// Ex?cute l?op?ration ? reservations ?.
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'client_id');
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
// Ex?cute l?op?ration ? casts ?.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
