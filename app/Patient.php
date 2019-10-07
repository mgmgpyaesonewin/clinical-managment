<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable=['name','dob','gender','hospital_id','address','phone_number','city','user_id'];
}
