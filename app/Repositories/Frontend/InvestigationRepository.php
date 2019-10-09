<?php 
namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use App\Investigation;

class InvestigationRepository extends BaseRepository{
    
    public function model() {
        return Investigation::class;
    }
    public function perHospital(){
      return   $this->model::join('patients as p','p.id','investigations.patient_id')
        ->join('hospitals as h' ,'p.hospital_id','h.id')
        ->where('h.id',auth('api')->user()->hospital_id)
        ->with('doctor','patient')
        ->select('investigations.*','p.hospital_id','p.name')
        ->orderBy('created_at','desc');
    }
}