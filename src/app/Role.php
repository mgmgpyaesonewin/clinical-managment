<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as RoleModel;

class Role extends RoleModel
{
    public function getNameAttribute()
    {
        return explode('#',$this->attributes['name'])[1];
    }
}
