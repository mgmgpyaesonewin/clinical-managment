<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Repositories\Frontend\PatientRepository;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $patientrepo;
    public function __construct(PatientRepository $repo)
    {
        $this->middleware('auth:api');
        $this->patientrepo = $repo;
    }
    public function index(Request $request)
    {
        $paginator = $this->patientrepo
        ->hospital()
        ->when($request->query('query'),function($query) use($request){
            return $query->where('id',$request->query('query'));
        })
        ->orderBy('created_at','desc')->paginate(5);
        // $paginator->count=$paginator->total;
        $fake = $paginator->toArray();
        $fake['count'] = $fake['total'];
        return $fake;
    }
    public function searchPatient(Request $req){
        return $this->patientrepo
                    ->orWhere('name','like',"%$req->key%")
                    // ->orWhere('nrc','like',"%$req->key%")
                    ->hospital()
                    // ->select('name','id')
                    ->get();
    }
    public function all()
    {
        return $this->patientrepo
            ->where('hospital_id', auth('api')->user()->hospital_id)
            ->orderBy('created_at', 'desc')->all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        return $this->patientrepo->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = $this->patientrepo->getById($id);
        return collect($patient)->except('hospital_id');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
        return $this->patientrepo->updateById($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->patientrepo->deleteById($id);
    }
}
