<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model {

    protected $table = 'lab';
    protected $fillable = ['id', 'user_id', 'name', 'mobile', 'telephone', 'city', 'address', 'photo', 'created_at', 'updated_at'];

    public function account() {
        return $this->belongsTo('App\User', 'id');
    }

}
