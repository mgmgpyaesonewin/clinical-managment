<?php

namespace App\Repositories\Frontend;

use App\Repositories\BaseRepository;
use App\AdditionalService;

class AdditionalServiceRepository extends BaseRepository
{
    public function model()
    {
        return AdditionalService::class;
    }
}
