<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = ['type', 'code', 'status', 'action', 'duration', 'consultation_id', 'patient_id', 'start_time', 'end_time'];

    public function consultation()
    {
        return $this->belongsTo('App\Consultation', 'consultation_id');
    }

    public function requests()
    {
        return $this->hasMany('App\Request', 'problem_id');
    }

    public function examinations()
    {
        return $this->hasMany('App\Examination', 'problem_id');
    }
    public function reportdocuments(){
        return $this->hasMany('App\ReportDocument','problem_id');
    }
}

