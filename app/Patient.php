<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable=['name','dob','gender','deposit','nrc','hospital_id','address','phone_number','city','user_id'];

    public function scopeHospital($query){
        return $query->where('hospital_id',auth('api')->user()->hospital_id);
    }
}
