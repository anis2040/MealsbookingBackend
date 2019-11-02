<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
