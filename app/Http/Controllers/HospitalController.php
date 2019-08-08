<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Http\Request;
use App\Repositories\Frontend\HospitalRepository;
use App\Http\Requests\HospitalRequest;

class HospitalController extends Controller
{
    public $hospital;
    public function __construct(HospitalRepository $hospitalRepository)
    {
        $this->hospital = $hospitalRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = $this->hospital->paginate(15);
        return view('hospital.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('hospital.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HospitalRequest $request)
    {  
        $hospital = $this->hospital->create($request->validated());
        return redirect('hospital')->with('success', 'Hospital has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hospital = $this->hospital->getById($id);
        return view('hospital.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(HospitalRequest $request, $id)
    {
        $hospital = $this->hospital->updateById($id, $request->validated());
        return redirect('hospital')->with('success', 'Hospital has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->hospital->deleteById($id);
        return redirect('hospital')->with('success', 'Hospital has been deleted');
    }
}
