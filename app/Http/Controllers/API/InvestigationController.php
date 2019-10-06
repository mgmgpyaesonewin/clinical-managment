<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvestigationRequest;
use App\Investigation;
use App\Http\Requests\NewInvestRequest;
use App\Repositories\Frontend\InvestigationRepository;

class InvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $investRepo=null;
    public function __construct(InvestigationRepository $repo)
    {
        $this->investRepo=$repo;
    }
    public function index(Request $req)
    {
        return $this->investRepo->where('type', 'i')->with('consultation','doctor')
        ->orderBy('created_at','desc')->get();
    }

    public function investigationPerConsultation(Request $req)
    {
        return $this->investRepo->with('consultation','doctor')
        ->where('type','i')
        ->where('consultation_id','=',$req->id)
        ->orderBy('created_at','desc')->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewInvestRequest $request)
    {
        return $this->investRepo->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvestigationRequest $request, $id)
    {
        // dd($request->validated());
        $invest = $this->investRepo->updateById($id,$request->validated());
        return $this->investRepo->with('doctor','consultation')->getById($invest->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->investRepo->deleteById($id);
    }
}
