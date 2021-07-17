<?php

namespace App\Repositories\Frontend;

use App\Repositories\BaseRepository;
use App\Role;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return Role::class;
    }
}
