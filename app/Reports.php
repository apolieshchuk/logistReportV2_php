<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $fillable = [
        'date',
        'manager_id',
        'cargo_id',
        'route_id',
        'carrier_id',
        'auto_num',
        'trail_num',
        'driver_id',
        'f2',
        'f1',
        'tr'];

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
