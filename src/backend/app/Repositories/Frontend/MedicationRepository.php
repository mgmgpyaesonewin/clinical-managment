<?php

namespace App\Repositories\Frontend;

use App\Medication;
use App\Repositories\BaseRepository;

class MedicationRepository extends BaseRepository
{
    public function model()
    {
        return Medication::class;
    }
}
