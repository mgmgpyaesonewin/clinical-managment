<?php

namespace App\Repositories\Frontend;

use App\Problem;
use App\Repositories\BaseRepository;

class ProblemRepository extends BaseRepository{


    public function model() {
       return Problem::class;
    }

}