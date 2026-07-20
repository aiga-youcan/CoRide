<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'trajet_id',
        'passager_id',
        'statut',
        'date_reservation',
        'ai_result',
    ];

    protected $casts = [

    'date_reservation'=>'datetime',

    'ai_result'=>AiResultCast::class,

];

    // Une réservation appartient à un trajet
    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    // Une réservation appartient à un passager (User)
    public function passager()
    {
        return $this->belongsTo(User::class, 'passager_id');
    }
}