<?php

namespace App;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{

    protected $fillable=['patient_id','title','comment','date','time','doctor_id','appointment_id'];
    public function getcreatedAtAttribute($value){
        $time=Carbon::createFromFormat('Y-m-d H:i:s',$value)->setTimeZone('Asia/Rangoon')->format('Y-m-d H:i:s');
        return $time;
    }
    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id');
    }
}
