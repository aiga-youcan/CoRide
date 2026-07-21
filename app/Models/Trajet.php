<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'conducteur_id',
        'ville_depart',
        'ville_arrivee',
        'horaire',
        'places_disponibles',
        'jours_recurrence',
    ];

    
    // Un trajet appartient à un conducteur (User)
    public function conducteur()
    {
        return $this->belongsTo(User::class, 'conducteur_id');
    }

    // Un trajet possède plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}