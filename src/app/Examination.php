<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $table = 'examination';
    protected $fillable = ['values', 'problem_id', 'consultation_id', 'patient_id'];

    public function setValuesAttribute($options)
    {
        $this->attributes['values'] = json_encode($options);
    }
}
