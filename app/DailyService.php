<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyService extends Model
{
    protected $guarded=[];


    public function services()
    {
        return $this->hasManyThrough('App\Service', 'App\ServiceGroup');
    }
    public function dummpyservices()
    {
        return $this->hasMany('App\ServiceGroup', 'daily_service_id');
    }
}
