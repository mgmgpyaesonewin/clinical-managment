<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Consultation extends Model
{
    protected $fillable = ['type', 'address', 'patient_id', 'title', 'comment', 'date', 'time', 'doctor_id', 'appointment_id'];

    public function getcreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->setTimeZone('Asia/Rangoon')->format('Y-m-d H:i:s');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    public function problems()
    {
        return $this->hasMany('App\Problem', 'consultation_id');
    }
}
