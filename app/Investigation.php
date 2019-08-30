<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $fillable=['term','value','doctor_id','code','consultation_id','type','snomed_ct','range'];
    
    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id');
    }

    public function consultation()
    {
        return $this->belongsTo('App\Consultation','consultation_id');
    }
}
