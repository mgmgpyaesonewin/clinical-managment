<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','quantity','hospital_id','price','description','min_order','max_order'];
}
