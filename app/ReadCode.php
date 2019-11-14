<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadCode extends Model
{
    protected $fillable=['code','block_id','title','class_kind','depth_in_kind','is_residual','chapter_no','is_leaf','no_of_non_residual_children'];
}
