<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {

    protected $table = 'patient';
    protected $fillable = ['user_id', 'nik', 'name', 'city', 'address', 'mobile', 'telephone', 'gender', 'birth_date', 'notes', 'photo', 'created_at', 'updated_at'];

    public function checkup() {
        return $this->hasOne('App\Checkup');
    }

    public function account() {
        return $this->belongsTo('App\User', 'id');
    }

}
