<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    // protected $fillable=['drug','dosage','qty','duration','type','doctor_id','consultation_id'];
    protected $guarded=[];
    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id');
    }

    public function consultation()
    {
        return $this->belongsTo('App\Consultation','consultation_id');
    }
}
