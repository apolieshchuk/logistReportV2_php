<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    public function reports() {
        return $this->hasMany(Reports::class);
    }
}
