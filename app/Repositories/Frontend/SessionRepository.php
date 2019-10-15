<?php

namespace App\Repositories\Frontend;
use App\Repositories\BaseRepository;
use App\Session;

class SessionRepository extends BaseRepository {
  
  public function model() {
      return Session::class;
  }

}
