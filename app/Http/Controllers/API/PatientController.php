<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Repositories\Frontend\PatientRepository;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $patientrepo;
    public function __construct(PatientRepository $repo)
    {   
        $this->middleware('auth:api');
        $this->patientrepo=$repo;
    }
    public function index(Request $request)
    {
        $hospital_id = Auth::user()->hospital_id;
        return $this->patientrepo->where('hospital_id','=',$hospital_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        $patient = $this->patientrepo->create($request->validated());
        return $patient;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = $this->patientrepo->getById($id);
        return collect($patient)->except('hospital_id');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
       $patient = $this->patientrepo->updateById($id,$request->validated());
       return $patient;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->patientrepo->deleteById($id);
    }
}
