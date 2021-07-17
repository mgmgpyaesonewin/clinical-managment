<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class ReadCode extends Model
{
    use Searchable;
    public function toSearchableArray()
    {
        $array = $this->toArray();
        $new['code']=$array['code'];
        $new['title']=$array['title'];
        $new[$this->getKeyName()] = $this->getKey();
        return $new;
    }
    protected $fillable=['code','block_id','title','class_kind','depth_in_kind','is_residual','chapter_no','is_leaf','no_of_non_residual_children'];
}
