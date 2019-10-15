<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
   protected $guarded=[];



   public function slots()
   {
       return $this->hasMany('App\SessionInterval','session_id');
   }

}
