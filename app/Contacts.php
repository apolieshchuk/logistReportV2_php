<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = [
        'surname',
        'name',
        'father',
        'post_id',
        'tel',
        'license'
    ];

    public function post() {
        return $this->belongsTo(Posts::class);
    }

    public function autos() {
        return $this->hasMany(Autos::class);
    }

    public function reports() {
        return $this->hasMany(Reports::class);
    }
}
