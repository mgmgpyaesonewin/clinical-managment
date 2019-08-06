<?php

namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use App\Http\Requests\UserRequest;
use App\User;

class UserRepository extends BaseRepository {
  
  public function model() {
      return User::class;
  }

}
