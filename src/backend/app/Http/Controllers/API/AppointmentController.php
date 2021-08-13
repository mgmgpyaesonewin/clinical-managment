<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Repositories\Frontend\AppointmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    private $appointment;

    public function __construct(AppointmentRepository $appointmentRepo)
    {
        // $this->middleware('auth:api');
        $this->appointment = $appointmentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $date= $req->date;
        return $this->appointment
        ->where('appointments.doctor_id',$req->id)
        ->where('s.date',$date)
        ->join('sessions as s','s.id','appointments.session_id')
        ->select('s.date','appointments.*')
        ->with([
        'session',
        'patient',
        'session_interval'
        ])
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {

        $data = $request->validated();
        $data['authorizer_id'] = auth('api')->user()->id;

        return $this->appointment->create($data);
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
    public function update(Request $request, $id)
    {
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
