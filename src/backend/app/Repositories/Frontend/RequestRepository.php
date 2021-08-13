<?php

namespace App\Repositories\Frontend;

use App\Request;
use App\Repositories\BaseRepository;

class RequestRepository extends BaseRepository{


    public function model() {
       return Request::class;
    }

}
