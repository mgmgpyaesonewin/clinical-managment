<?php

namespace App\Repositories\Frontend;

use App\Repositories\BaseRepository;
use App\SessionInterval;

class SessionIntervalRepository extends BaseRepository
{
    public function model()
    {
        return SessionInterval::class;
    }
}
