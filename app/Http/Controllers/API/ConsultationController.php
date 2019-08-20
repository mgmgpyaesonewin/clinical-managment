<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Repositories\Frontend\ConsultationRepository;
use DateTime;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $consultrepo=null;
    public function __construct(ConsultationRepository $repo)
    {
        $this->consultrepo=$repo;
    }

    public function index(Request $req)
    {
        // dd(auth('api')->check());
        return $this->consultrepo->with('doctor')->where('patient_id','=',$req->id)->orderBy('created_at','desc')->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsultationRequest $request)
    {

        // dd($request->validated());
     $consult= $this->consultrepo->with('doctor')
       ->create($request->validated());
       return $this->consultrepo->with('doctor')->getById($consult->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consult = $this->consultrepo->with('doctor')->getById($id);
        return collect($consult)->except('hospital_id');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsultationRequest $request, $id)
    {
        $consult = $this->consultrepo->updateById($id,$request->validated());
        return $this->consultrepo->with('doctor')->getById($consult->id);
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
