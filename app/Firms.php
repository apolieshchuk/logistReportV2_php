<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firms extends Model
{
    public function bills() {
        return $this->hasMany(Bills::class);
    }
}
