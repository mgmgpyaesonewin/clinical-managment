<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DailyService;
use App\Repositories\Frontend\DailyServiceRepository;

class DailyServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $repo;
    public function __construct(DailyServiceRepository $repo)
    {
        // $this->middleware('auth:api');
        $this->repo = $repo;
    }
    public function index(DailyServiceRepository $repo,Request $req)
    {
        $data=$repo->where('patient_id',$req->id)
        ->whereNull('end_date')
        ->with('services')
        ->get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DailyService $request)
    {
    //    return $request->validated();
        $data['patient_id']= $request->patient_id;
        $data['start_date']=$request->start_date;
        $dailyservice= $this->repo->create($data);
        $services=$request->services;
       return $dailyservice->dummpyservices()->createMany($services);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $services=$request->services;
        $dailyservice=$this->repo->getById($id);
        $dailyservice->services()->detach();
        return $dailyservice->services()->attach($services,['user_id'=>$request->user_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
