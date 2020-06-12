<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function getCode($classifier)
    {
        return $this->where('classifier', $classifier)->first()->code ?? null;
    }
}