<?php

namespace App\Skills;

use Carbon\Carbon;

class CalculateCompatibility
{
    public function handle(array $data): array
    {
        $score = 0;
        $raisons = [];

        // Ville départ
        if (
            strtolower(trim($data['ville_depart_conducteur'])) ==
            strtolower(trim($data['ville_depart_passager']))
        ) {
            $score += 30;
            $raisons[] = "Même ville de départ";
        }

        // Ville arrivée
        if (
            strtolower(trim($data['ville_arrivee_conducteur'])) ==
            strtolower(trim($data['ville_arrivee_passager']))
        ) {
            $score += 30;
            $raisons[] = "Même destination";
        }

        // Horaire
        try {
            $h1 = Carbon::parse($data['horaire_conducteur']);
            $h2 = Carbon::parse($data['horaire_passager']);

            $diff = abs($h1->diffInMinutes($h2));

            if ($diff <= 15) {
                $score += 25;
                $raisons[] = "Horaire très proche";
            } elseif ($diff <= 30) {
                $score += 15;
                $raisons[] = "Horaire proche";
            } elseif ($diff <= 60) {
                $score += 5;
                $raisons[] = "Horaire acceptable";
            }
        } catch (\Exception $e) {
        }

        // Jours
        $joursConducteur = explode(',', strtolower($data['jours_conducteur']));
        $joursPassager = explode(',', strtolower($data['jours_passager']));

        if (count(array_intersect($joursConducteur, $joursPassager)) > 0) {
            $score += 15;
            $raisons[] = "Jours compatibles";
        }

        if ($score > 100) {
            $score = 100;
        }

        if ($score >= 80) {
            $niveau = "Excellent";
            $compatible = true;
        } elseif ($score >= 60) {
            $niveau = "Bon";
            $compatible = true;
        } elseif ($score >= 40) {
            $niveau = "Moyen";
            $compatible = false;
        } else {
            $niveau = "Faible";
            $compatible = false;
        }

        return [
            "score" => $score,
            "compatible" => $compatible,
            "niveau" => $niveau,
            "justification" => implode(", ", $raisons),
            "horaire_suggere" => $data['horaire_conducteur'],
        ];
    }
}