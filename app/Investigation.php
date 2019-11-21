<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $guarded=[];
    
    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient','patient_id');
    }

    public function consultation(){
        return $this->belongsTo('App\Consultation','consultation_id');

    }
}
