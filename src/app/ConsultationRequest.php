<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    protected $fillable = ['patient_id', 'requested', 'consultation_id', 'problem_id'];

    public function setRequestedAttribute($options)
    {
        $this->attributes['requested'] = json_encode($options);
    }
}
