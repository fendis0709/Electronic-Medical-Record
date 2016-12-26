<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkup extends Model {

    protected $table = 'checkup';
    protected $fillable = ['doctor_id', 'patient_id', 'result', 'date', 'symtomp', 'note'];

    public function doctor() {
        return $this->belongsTo('App\Doctor', 'id');
    }

    public function patient() {
        return $this->belongsTo('App\Patient', 'id');
    }

}
