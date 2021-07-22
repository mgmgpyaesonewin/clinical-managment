<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestigationRequest;
use App\Http\Requests\NewInvestRequest;
use App\Repositories\Frontend\InvestigationRepository;
// use App\Http\Requests\NewInvestRequest;
use Illuminate\Http\Request;

class InvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $investRepo;

    public function __construct(InvestigationRepository $repo)
    {
        $this->investRepo = $repo;
    }

    public function index(Request $req)
    {
        $null = 'pending' === $req->status ? 'pending' : null;
        $notnull = 'completed' === $req->status ? 'completed' : null;

        return $this->investRepo->perHospital()
            ->when($null, function ($query) {
                $query->whereNull('value');
            })
            ->when($notnull, function ($query) {
                $query->whereNotNull('value');
            })
            ->where('investigations.type','i')
            ->when($req->search, function ($q) use ($req) {
                $q->where('p.name', 'like', '%' . $req->search . '%');
            })
            ->get();
    }

    public function investigationPerPatient(Request $req)
    {
        return $this->investRepo->with('doctor', 'patient')
            ->where('type', 'i')
            ->where('patient_id', '=', $req->id)
            ->orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(NewInvestRequest $request)
    {
        $invest = $this->investRepo->create($request->validated());

        return $this->investRepo->with('doctor')->getById($invest->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(InvestigationRequest $request, $id)
    {
        $invest = $this->investRepo->updateById($id, $request->validated());

        return $this->investRepo->with('doctor', 'patient')->getById($invest->id);
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
        $this->investRepo->deleteById($id);
    }
}
