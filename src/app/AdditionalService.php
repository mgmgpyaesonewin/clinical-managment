<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    protected $guarded=[];


public function service(){
    return $this->belongsTo('App\Service', 'service_id');
}
}
