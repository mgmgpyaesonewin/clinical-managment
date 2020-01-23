<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExaminationRequest;
use App\Repositories\Frontend\InvestigationRepository;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ExamRepo=null;
    public function __construct(InvestigationRepository $investrepo)
    {
        $this->ExamRepo=$investrepo;
    }
    public function index()
    {
        return $this->ExamRepo
        ->where('type', 'x')
        ->with('consultation','doctor')
        ->orderBy('created_at','desc')->get();
    }

    public function examinationPerConsultation(Request $req)
    {
        return $this->ExamRepo->with('consultation','doctor')
        ->where('type','x')
        ->where('consultation_id','=',$req->id)
        ->orderBy('created_at','desc')->get();
    }

    public function examinationPerPatient(Request $req)
    {
        return $this->ExamRepo->with('consultation','doctor')
        ->where('type','x')
        ->where('patient_id','=',$req->id)
        ->orderBy('created_at','desc')->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExaminationRequest $request)
    {
        // dd($request->all();
        return $this->ExamRepo->create($request->validated());
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
    public function update(ExaminationRequest $request, $id)
    {
        $invest = $this->ExamRepo->updateById($id,$request->validated());
        return $this->ExamRepo->with('doctor','consultation')->getById($invest->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ExamRepo->deleteById($id);
    }
}
