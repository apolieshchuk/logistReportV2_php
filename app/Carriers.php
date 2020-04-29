<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carriers extends Model
{
    public function autos() {
        return $this->hasMany(Autos::class);
    }

    public function reports() {
        return $this->hasMany(Reports::class);
    }
}
