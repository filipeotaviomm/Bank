<?php

namespace App\Http\Controllers; //quase todos arquivos tem que ter isso com o caminho

use App\Http\Requests\CreateUserRequest;
use App\Services\CreateUserService;


class UserController extends Controller
{
  public function create(CreateUserRequest $request)
  {
    $createUserService = new CreateUserService();

    return $createUserService->execute($request->all());
  }
}
