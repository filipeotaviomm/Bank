<?php

namespace App\Http\Controllers; //quase todos arquivos tem que ter isso com o caminho

use App\Http\Requests\{CreateUserRequest, CreateDepositRequest};
use App\Services\{CreateUserService, CreateDepositService};


class UserController extends Controller
{
  public function create(CreateUserRequest $request)
  {
    $createUserService = new CreateUserService();

    return $createUserService->execute($request->all());
  }

  public function deposit(CreateDepositRequest $request)
  {
    $createDepositService = new CreateDepositService();

    return $createDepositService->execute($request->id, $request->value);
    //o primeiro parâmetro também poderia ser auth()->user()->id
    //o $request também tem acesso à url, por isso $request->id funciona tmb
  }
}
