<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'city',
        'address',
        'mobile',
        'telephone',
        'status',
        'remember_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'users';
    public $timestamps = TRUE;

    public function patient() {
        return $this->hasOne('App\Patient');
    }

    public function doctor() {
        return $this->hasOne('App\Doctor');
    }

    public function lab() {
        return $this->hasOne('App\Lab');
    }

}
