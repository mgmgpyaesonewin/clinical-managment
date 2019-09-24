<?php 
namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use App\Medication;

class MedicationRepository extends BaseRepository{
    
    public function model() {
        return Medication::class;
    }
}