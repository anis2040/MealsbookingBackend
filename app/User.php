<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function restaurants() {
        return $this->hasMany(Restaurant::class);
    }
    public function ratings() {
        return $this->hasMany(Rating::class);
    }
    public function claims() {
        return $this->hasMany(Claim::class);
    }
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
