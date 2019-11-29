<?php

namespace App\Repositories\Frontend;

use App\Appointment;
use App\Repositories\BaseRepository;

class AppointmentRepository extends BaseRepository
{
    public function model()
    {
        return Appointment::class;
    }
}
