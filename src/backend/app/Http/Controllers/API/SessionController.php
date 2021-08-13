<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SessionRequest;
use App\Repositories\Frontend\SessionIntervalRepository;
use App\Repositories\Frontend\SessionRepository;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $session_repo;

    public function __construct(SessionRepository $repo)
    {
        $this->session_repo = $repo;
    }

    public function index(Request $req)
    {
        $date = $req->date;

        return $this->session_repo
            ->with('slots')
            ->where('doctor_id', $req->id)
            ->when($date, function ($query, $date) {
                return $query->whereDate('date', $date);
            })
            ->get()
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SessionRequest $req)
    {
        // dd($req->validated());
        $data = $req->validated();
        $arrayDates = explode(',', $data['date']);
        foreach ($arrayDates as $key => $value) {
            $data['date'] = $value;
            $this->session_repo->create($data)->slots()->createMany($req->intervals);
        }

        return 'true';
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
    public function update(SessionRequest $req, $id, SessionIntervalRepository $si)
    {
        $data = $this->session_repo->getById($id);
        $data->update($req->validated());
        $si->where('session_id', $id)->delete();
        $data->slots()->createMany($req->intervals);

        return $data;
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
        $session = $this->session_repo->getById($id);
        $session->slots()->delete();
        $session->delete();
    }
}
