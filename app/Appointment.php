<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function session()
    {
        return $this->belongsTo('App\Session','session_id');
    }

    public function session_interval()
    {
        return $this->belongsTo('App\SessionInterval','session_interval_id');
    }
    public function patient()
    {
        return $this->belongsTo('App\Patient','patient_id');
    }


    protected $fillable=['patient_id','authorizer_id','doctor_id','session_id','session_interval_id'];
}
