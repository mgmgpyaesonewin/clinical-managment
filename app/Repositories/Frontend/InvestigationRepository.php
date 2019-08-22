<?php 
namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use App\Investigation;

class InvestigationRepository extends BaseRepository{
    
    public function model() {
        return Investigation::class;
    }
}