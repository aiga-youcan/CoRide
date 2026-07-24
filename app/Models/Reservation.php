<?php

namespace App\Models;

use App\Casts\AiResultCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Casts for model attributes.
     * Use the $casts property so Eloquent applies the AiResultCast.
     */
    protected $casts = [
        'ai_result' => AiResultCast::class,
        'date_reservation' => 'date',
    ];

    // Une réservation appartient à un trajet
    public function trajet()
    {
        return $this->belongsTo(Trajet::class, 'trajet_id');
    }

    // Une réservation appartient à un passager (User)
    public function passager()
    {
        return $this->belongsTo(User::class, 'passager_id');
    }
}
