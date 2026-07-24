<?php

namespace App\Skills;

class ExplainResultSkill
{
    public function handle(int $score): string
    {
        if ($score >= 90) {
            return "Très forte compatibilité.";
        }

        if ($score >= 70) {
            return "Bonne compatibilité.";
        }

        if ($score >= 50) {
            return "Compatibilité moyenne.";
        }

        return "Faible compatibilité.";
    }
}