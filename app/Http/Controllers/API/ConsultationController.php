<?php

namespace App\Http\Controllers\API;

use App\Consultation;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Repositories\Frontend\ConsultationRepository;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $consultrepo;

    public function __construct(ConsultationRepository $repo)
    {
        $this->consultrepo = $repo;
    }

    public function index(Request $req)
    {
        return Consultation::with(['doctor', 'problems.requests', 'problems.examinations'])->where('patient_id', '=', $req->id)->orderBy('created_at', 'desc')->get();
        // return $this->consultrepo->with(['doctor', 'problems.requests', 'problems.examinations'])->where('patient_id', '=', $req->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ConsultationRequest $request)
    {
        $consult = $this->consultrepo->with('doctor')
            ->create($request->validated())
        ;

        return $this->consultrepo->with('doctor')->getById($consult->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consult = $this->consultrepo->with(['doctor', 'problems.requests', 'problems.examinations'])->getById($id);
        // return Consultation::with(['doctor', 'problems.requests', 'problems.examinations'])->where('patient_id', '=', $req->id)->orderBy('created_at', 'desc')->get();

        return collect($consult)->except('hospital_id');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ConsultationRequest $request, $id)
    {
        $consult = $this->consultrepo->updateById($id, $request->validated());

        return $this->consultrepo->with('doctor')->getById($consult->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
