<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{

    public function manager() {
        return $this->belongsTo(Contacts::class, 'manager_id', 'id');
    }

    public function cargo() {
        return $this->belongsTo(Cargos::class);
    }

    public function route() {
        return $this->belongsTo(Routes::class);
    }

    public function carrier() {
        return $this->belongsTo(Carriers::class);
    }

    public function driver() {
        return $this->belongsTo(Contacts::class, 'driver_id', 'id');
    }
}
