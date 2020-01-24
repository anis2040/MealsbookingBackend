<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name','description','photo','address','priceMin','priceMax'];


    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
    public function image(){
        return $this->hasOne(Image::class);
    }
    public function ratings() {
        return $this->hasMany(Rating::class);
    }
    public function menus() {
        return $this->hasMany(Menu::class);
    }
}
