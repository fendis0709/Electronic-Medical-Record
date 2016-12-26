<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab_checkup extends Model
{
    protected $table = 'lab_checkup';
    protected $fillable = ['checkup_id', 'patient_id', 'result', 'date', 'notes', 'photo'];
    
}
