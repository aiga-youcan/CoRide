<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'entreprise',
        'ville_residence',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relations

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise', 'nom');
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class, 'conducteur_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'passager_id');
    }
}
