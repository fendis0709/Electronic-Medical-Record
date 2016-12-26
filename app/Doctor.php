<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {

    protected $table = 'doctor';
    protected $fillable = ['id', 'user_id', 'name', 'gender', 'birth_date', 'specialization', 'city', 'address', 'telephone', 'mobile', 'photo', 'created_at', 'updated_at'];

    public function checkup() {
        return $this->hasOne('App\Checkup');
    }

    public function account() {
        return $this->belongsTo('App\User', 'id');
    }

}
