<?php 
namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use App\DailyService;

class DailyServiceRepository extends BaseRepository{
    
    public function model() {
        return DailyService::class;
    }
}
