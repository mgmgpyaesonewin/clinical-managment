<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $fillable=['term','value','doctor_id','code','snomed_ct','range'];
    
    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id');
    }
}
