<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription_detail extends Model {

    protected $table = 'prescription_detail';
    protected $fillable = ['prescription_id', 'medicine', 'dosage', 'rule_of_use', 'is_verified'];

    public function prescription() {
        return $this->belongsTo('App\Prescription', 'id');
    }

}
