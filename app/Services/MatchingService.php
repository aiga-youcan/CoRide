<?php

namespace App\Services;

use App\Models\Trajet;
use App\Models\User;
use Illuminate\Support\Facades\AI;

class MatchingService
{
    public function analyse(User $passager, Trajet $trajet)
    {
        $result = AI::chat()->structured(
            schema: [
                'type' => 'object',
                'properties' => [
                    'score' => [
                        'type' => 'integer'
                    ],
                    'justification' => [
                        'type' => 'string'
                    ],
                    'horaire_suggere' => [
                        'type' => 'string'
                    ]
                ]
            ],
            messages: [
                [
                    'role'=>'system',
                    'content'=>'Tu es un assistant spécialisé dans le covoiturage.'
                ],
                [
                    'role'=>'user',
                    'content'=>"
Passager :

Ville : {$passager->ville_residence}

Trajet :

Départ : {$trajet->ville_depart}

Arrivée : {$trajet->ville_arrivee}

Horaire : {$trajet->horaire}

Donne un score de compatibilité entre 0 et 100 avec une justification."
                ]
            ]
        );

        return $result;
    }
}