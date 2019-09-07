<?php

namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository {
  
  public function model() {
      return Role::class;
  }

}
