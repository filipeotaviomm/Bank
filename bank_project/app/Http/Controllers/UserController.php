<?php

namespace App\Http\Controllers; //quase todos arquivos tem que ter isso com o caminho

use App\Http\Requests\{CreateUserRequest, CreateDepositRequest, UpdateUserRequest};
use App\Services\{CreateUserService, CreateDepositService, DeleteUserService, ReadUserService, UpdateUserService};


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
    //o primeiro parâmetro também poderia ser auth()->user()->id que seria o id que vem do token
    //o $request também tem acesso à url, por isso $request->id funciona tmb
  }

  public function readUser(string $id)
  {
    $readUserService = new ReadUserService();

    return $readUserService->getUserById($id);
  }

  public function readUsers()
  {
    $readUserService = new ReadUserService();

    return $readUserService->getAllUsers();
  }

  public function updateUser(UpdateUserRequest $request, string $id)
  {
    $updateUserService = new UpdateUserService();

    return $updateUserService->execute($id, $request->validated());
  }

  public function deleteUser(string $id)
  {
    $deleteUserService = new DeleteUserService;

    $deleteUserService->execute($id);
  }
}
