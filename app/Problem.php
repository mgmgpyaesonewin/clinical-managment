<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable=['type','code','status','consultation_id','patient_id','start_time','end_time','name'];

    public function consultation()
    {
        return $this->belongsTo('App\Consultation','consultation_id');
    }
}
