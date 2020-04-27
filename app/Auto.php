<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    public function carrier() {
        return $this->belongsTo(Carrier::class);
    }
}
