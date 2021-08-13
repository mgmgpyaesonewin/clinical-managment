<?php

namespace App;
use App\Scopes\HospitalScope as Hscope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new Hscope);
    }
    protected $guarded=[];

    public function scopeHospital($query){
        return $query->where('hospital_id',auth('api')->user()->hospital_id);
    }
}
