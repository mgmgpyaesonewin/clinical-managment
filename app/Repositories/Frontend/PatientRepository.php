<?php 
namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use App\Patient;

class PatientRepository extends BaseRepository {

    public function model()
    {
        return Patient::class;
    }

}