<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SessionRequest;
use App\Repositories\Frontend\SessionRepository;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $session_repo;
    public function __construct(SessionRepository $repo)
    {
        $this->session_repo= $repo;    
    }
    public function index(Request $req)
    {
      return $this->session_repo
            ->with('slots')
            ->where('doctor_id',$req->id)
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SessionRequest $req)
    {
        $data=$req->validated();
        return $this->session_repo->create($data)->slots()->createMany($req->intervals);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $session = $this->session_repo->getById($id);   
       $session->slots()->delete();
       $session->delete();
    }
}
