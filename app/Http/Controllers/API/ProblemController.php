<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProblemRequest;
use App\Repositories\Frontend\ProblemRepository;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $prob;
    public function __construct(ProblemRepository $repo)
    {
        $this->prob = $repo;
    }
    public function index()
    {
        return $this->prob->orderBy('created_at','desc')->get();
    }
    public function problemPerConsultation(Request $req){
        return $this->prob->with('consultation','consultation.doctor')
            ->where('consultation_id','=',$req->id)
            ->orderBy('created_at','desc')
            ->get();
    }

    public function problemsPerPatient(Request $req){
        return $this->prob->with('consultation','consultation.doctor')
            ->where('patient_id','=',$req->id)
            ->orderBy('created_at','desc')
            ->get()
            ->groupBy(['type','status']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProblemRequest $request)
    {
      return $this->prob->create($request->validated());
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
    public function update(ProblemRequest $request, $id)
    {
        $this->prob->updateById($id,$request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->prob->deleteById($id);

    }
}
