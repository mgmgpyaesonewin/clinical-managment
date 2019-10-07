<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $fillable=['term','value','doctor_id','code','patient_id','type','snomed_ct','range'];
    
    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient','patient_id');
    }
}
