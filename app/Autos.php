<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autos extends Model
{
    public function carrier() {
        return $this->belongsTo(Carriers::class);
    }

    public function driver() {
        return $this->belongsTo(Contacts::class);
    }
}
