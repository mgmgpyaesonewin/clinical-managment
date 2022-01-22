<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdditonalServiceRequest;
use App\Repositories\Frontend\AdditionalServiceRepository;
use Illuminate\Http\Request;

class AdditionalServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ASRepo;

    public function __construct(AdditionalServiceRepository $repo)
    {
        $this->ASRepo = $repo;
    }

    public function index(Request $req)
    {
        $data=$this->ASRepo->where('patient_id',$req->id)
        ->where('date',$req->date)
        ->with('service')
        ->get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdditonalServiceRequest $request)
    {
        return $this->ASRepo->create($request->validated());
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdditonalServiceRequest $request, $id)
    {
        $this->ASRepo->updateById($id, $request->validated());
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
        $this->ASRepo->getById($id)->delete();
    }
}