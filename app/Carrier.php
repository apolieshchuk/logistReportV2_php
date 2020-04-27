<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    public function auto() {
        return $this->hasMany(Auto::class);
    }
}
