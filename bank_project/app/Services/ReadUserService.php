<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class ReadUserService
{
  public function getUserById(string $userId)
  {
    $foundUser = User::find($userId);

    if (is_null($foundUser)) {
      throw new AppError("Usuário não encontrado", 404);
    }

    return $foundUser;
  }

  public function getAllUsers()
  {
    $users = User::all();

    return $users;
  }
}
