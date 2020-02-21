<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Repositories\Frontend\AdditionalServiceRepository;
use App\Repositories\Frontend\DailyServiceRepository;
use App\Repositories\Frontend\ServiceRepository;
use App\ServiceGroup;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $Srepo;
     public function __construct(ServiceRepository $repo)
     {
         $this->Srepo=$repo;
     }

    public function index()
    {
        return $this->Srepo
        ->hospital()
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
     return $this->Srepo->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function getServices(Request $req,DailyServiceRepository $daily_repo,AdditionalServiceRepository $As_repo ){
    //   return $req->all();
        $data['ds']=$daily_repo->where('patient_id',$req->id)
        ->whereNull('end_date')
        ->with('services')
        ->get();
        
        // return $data;
        $data['as']=$As_repo->where('patient_id',$req->id)
        ->where('date',$req->date)
        ->with('service')
        ->get();
        return $data;
  }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
       return $this->Srepo->updateById($id,$request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    return (string)$this->Srepo->getById($id)->delete();
        
    }
    public function removeGroupService(Request $req,ServiceGroup $sg){
    
        $sg->where('daily_service_id', $req->daily_service_id)
        ->where('service_id',$req->service_id)->delete();
   
    }
}
