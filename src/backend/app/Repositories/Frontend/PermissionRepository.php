<?php

namespace App\Repositories\Frontend;

use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }
}
