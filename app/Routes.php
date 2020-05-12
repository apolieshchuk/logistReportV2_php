<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{

    protected $fillable = ['name', 'km'];

    public function reports() {
        return $this->hasMany(Reports::class);
    }
}
