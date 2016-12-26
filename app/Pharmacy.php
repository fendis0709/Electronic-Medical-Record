<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model {
    protected $table = 'pharmacy';
    protected $fillable = ['id', 'user_id', 'name', 'mobile', 'telephone', 'city', 'address', 'photo'];
}
