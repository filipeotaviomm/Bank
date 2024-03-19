<?php

namespace App\Http\Controllers; //quase todos arquivos tem que ter isso com o caminho

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
  public function createUser(Request $request) {
    return User::create($request->all());
  }
}