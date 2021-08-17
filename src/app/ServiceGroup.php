<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    protected $guarded=[];

    protected $table='service_groups';

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }
}
