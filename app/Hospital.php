<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Hospital extends Model
{
    protected $fillable = ['name', 'address', 'phone_num', 'start_date', 'end_date'];
    protected $dates = ['start_date', 'end_date'];

    public function patients(){
        return $this->HasMany('App\Patient');
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }
}


