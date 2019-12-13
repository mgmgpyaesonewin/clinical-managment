<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable=['type','code','status','action','duration','consultation_id','patient_id','start_time','end_time'];

    public function consultation()
    {
        return $this->belongsTo('App\Consultation','consultation_id');
    }
}
