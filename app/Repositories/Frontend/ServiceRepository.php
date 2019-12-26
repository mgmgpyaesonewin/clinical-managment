<?php

namespace App\Repositories\Frontend;

use App\Repositories\BaseRepository;
use App\Service;

class ServiceRepository extends BaseRepository
{
    public function model()
    {
        return Service::class;
    }
}
