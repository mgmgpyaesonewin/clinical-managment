<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicationRequest;
use App\Repositories\Frontend\MedicationRepository;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $m_repo;
    public function __construct(MedicationRepository $repo){
        $this->m_repo=$repo;
    }
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicationRequest $request)
    {
        $data=$request->validated();
        return $this->m_repo->create($data);
    }
    public function medicationPerConsultationPerConsultation(Request $req){
        return $this->m_repo->with('consultation','doctor')
        ->where('consultation_id','=',$req->id)
        ->orderBy('created_at','desc')->get();
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
    public function update(MedicationRequest $request, $id)
    {
        $invest = $this->m_repo->updateById($id,$request->validated());
        return $this->m_repo->with('doctor','consultation')->getById($invest->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->m_repo->deleteById($id);
    }
}
