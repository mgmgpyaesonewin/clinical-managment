<?php

namespace App\Http\Controllers\API;

use App\ConsultationRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\ConsultationRequestRepository;
use Illuminate\Http\Request;

class ConsultationRequestController extends Controller
{
    private $conReq;

    public function __construct(ConsultationRequestRepository $repo)
    {
        $this->conReq = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->conReq->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ConsultationRequest $consultationRequest)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsultationRequest $consultationRequest)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsultationRequest $consultationRequest)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsultationRequest $consultationRequest)
    {
    }
}
