<?php

namespace App\Http\Controllers\API;

use App\Repositories\Frontend\PermissionRepository;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public $permission;
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->middleware('auth:api');
        $this->permission = $permissionRepository;
    }

    public function index()
    {
        return $this->permission->get();
    }
}
