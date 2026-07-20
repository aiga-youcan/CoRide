<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class AiResultCast implements CastsAttributes
{
    public function get($model,$key,$value,$attributes)
    {
        return json_decode($value,true);
    }

    public function set($model,$key,$value,$attributes)
    {
        return json_encode($value);
    }
}
