<?php

namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;

class UserRepository extends BaseRepository {
  
  public function model() {
      return Role::class;
  }

}
