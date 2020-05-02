<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autos extends Model
{
    protected $fillable = [
        'carrier_id',
        'mark',
        'auto_num',
        'trail_num',
        'driver_id',
        'notes',
    ];
    public function carrier() {
        return $this->belongsTo(Carriers::class);
    }

    public function driver() {
        return $this->belongsTo(Contacts::class);
    }
}
