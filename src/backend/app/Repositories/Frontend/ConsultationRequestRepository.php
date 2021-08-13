<?php

namespace App\Repositories\Frontend;

use App\ConsultationRequest;
use App\Repositories\BaseRepository;

class ConsultationRequestRepository extends BaseRepository
{
    public function model()
    {
        return ConsultationRequest::class;
    }
}
