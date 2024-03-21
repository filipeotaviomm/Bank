<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class UpdateUserService
{
  public function execute(string $userId, array $data)
  {
    $foundUser = User::find($userId);

    if (is_null($foundUser)) {
      throw new AppError("Usuário não encontrado", 404);
    }

    $foundUser->update($data);

    return $foundUser;
  }
}
