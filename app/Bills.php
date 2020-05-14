<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $guarded = [];

    public function carrier() {
        return $this->belongsTo(Carriers::class);
    }

    public function payer() {
        return $this->belongsTo(Firms::class);
    }

    public function route() {
        return $this->belongsTo(Routes::class);
    }
}
