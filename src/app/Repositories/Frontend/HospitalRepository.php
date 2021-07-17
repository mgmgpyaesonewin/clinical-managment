<?php 
namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use App\Hospital;

class HospitalRepository extends BaseRepository{
    
    public function model() {
        return Hospital::class;
    }
}
