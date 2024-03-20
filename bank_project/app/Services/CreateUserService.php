<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class CreateUserService
{
  public function execute(array $data)
  {
    $foundUser = User::firstWhere('email', $data['email']);

    if (!is_null($foundUser)) {
      throw new AppError("Esse email já existe", 400);
    }

    $foundUser = User::firstWhere('cpf', $data['cpf']);

    if (!is_null($foundUser)) {
      throw new AppError("Esse CPF já existe", 400);
    }

    return User::create($data);
  }
}
