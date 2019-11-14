<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable=['patient_id','authorizer_id','doctor_id','session_id','session_interval_id'];
}
