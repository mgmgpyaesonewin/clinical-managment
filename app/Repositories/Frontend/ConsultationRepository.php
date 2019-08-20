<?php 
namespace App\Repositories\Frontend;

use App\Consultation;
use App\Repositories\BaseRepository;

class ConsultationRepository extends BaseRepository{
    
    public function model() {
        return Consultation::class;
    }
}