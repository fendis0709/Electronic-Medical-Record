<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model {

    protected $table = 'prescription';
    protected $fillable = ['checkup_id', 'doctor_id', 'patient_id', 'date', 'note', 'amount'];

    public function prescription_detail() {
        return $this->hasOne('App\Prescription_detail');
    }
}
