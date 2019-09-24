<?php

namespace App\Http\Controllers\API;

use App\Repositories\Frontend\PermissionRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public $permission;
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->middleware('auth:api');
        $this->permission = $permissionRepository;
    }

    public function index(Request $request)
    {
        $id = $request->id;
        $permissions = $this->permission->get();
        $attached_permissions = Role::find($id)->permissions->pluck('id');
        return response()->json([
            'permissions' => $permissions,
            'attachedPermissions' => $attached_permissions
        ]);
    }
}
