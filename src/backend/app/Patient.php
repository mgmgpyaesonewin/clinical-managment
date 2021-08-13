<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable=['name','dob','gender','type','deposit','nrc','hospital_id','address','phone_number','city','user_id'];

    public function scopeHospital($query){
        return $query->where('hospital_id',auth('api')->user()->hospital_id);
    }

    public function activity(){
        return $this->HasMany('App\TransactionActivity','patient_id')->orderBy('created_at','desc');;
    }

}
