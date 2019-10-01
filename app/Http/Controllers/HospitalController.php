<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Http\Request;
use App\Repositories\Frontend\HospitalRepository;
use App\Http\Requests\HospitalRequest;
use App\Repositories\Frontend\PermissionRepository;
use App\Repositories\Frontend\RoleRepository;
use App\Repositories\Frontend\UserRepository;
use Illuminate\Support\Facades\Log;

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
    public function store(HospitalRequest $request, UserRepository $userRepo, RoleRepository $roleRep, PermissionRepository $permissionRepo)
    {  
        $user_info = $request->only('email','password','username');
        $hospital = $this->hospital->create($request->validated());
        $user = $userRepo->create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'hospital_id' => $hospital->id
        ]);
        $role = $roleRep->create([
            'name' => $hospital->id.'#SuperAdmin',
            'hospital_id' => $hospital->id,
            'guard_name' => 'api'
        ]);
        $permission = $permissionRepo->get();
        $role->givePermissionTo($permission);
        $user->assignRole($role);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit($id,UserRepository $userRepo)
    {
        $hospital = $this->hospital->getById($id)->first();
        $user= $userRepo->getById($hospital->id)->orderBy('id','asc')->first();
        $hospital->user = $user;
        return view('hospital.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(HospitalRequest $request, $id, UserRepository $userRepo)
    {
        Log::emergency('Showing user profile for user: '.$id);
        $hospital = $this->hospital->updateById($id, $request->validated());
        $user = $userRepo->updateById($id, [
            'name' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'hospital_id' => $hospital->id
        ]);
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
