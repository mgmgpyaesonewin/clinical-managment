<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    private $role;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->middleware('auth:api');
        $this->role = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospital_id = Auth::user()->hospital_id;
        return $this->role->where('hospital_id', $hospital_id)->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        return $this->role->create($request->validated());
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(RoleRequest $request, $id)
    {
        return $this->role->updateById($id,$request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->role->deleteById($id);
    }

    public function assignPermissions(Request $request) 
    {
        $role = $this->role->where('id', $request->roleId)->first();
        $permission = Permission::whereIn('id', $request->permissionIds)->get();
        $role->syncPermissions($permission);
        return response()->json(['message' => 'Assign Permissions successfully']);
    }
}
