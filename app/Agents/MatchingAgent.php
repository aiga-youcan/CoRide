<?php

namespace App\Agents;

use App\Skills\CalculateCompatibility;

class MatchingAgent
{
    protected CalculateCompatibility $skill;

    public function __construct()
    {
        $this->skill = new CalculateCompatibility();
    }

    public function analyze(array $data): array
    {
        return $this->skill->handle($data);
    }
}