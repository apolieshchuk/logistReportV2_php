<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{

    protected $fillable = ['name', 'km'];

    public function reports() {
        return $this->hasMany(Reports::class);
    }

    public function bills() {
        return $this->hasMany(Bills::class);
    }
}
