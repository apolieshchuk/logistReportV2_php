<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public function contacts() {
        return $this->hasMany(Contacts::class);
    }
}
