<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//CUrrently not used. Replace by User Model
class Account extends Model {

    protected $table = 'account';
    protected $fillable = ['id', 'email', 'password', 'name', 'city', 'address', 'mobile', 'telephone', 'status', 'remember_token', 'created_at', 'updated_at'];
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
