<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class DeleteUserService
{
  public function execute(string $userId)
  {
    $foundUser = User::find($userId);

    if (is_null($foundUser)) {
      throw new AppError('Usuário não encontrado', 404);
    }

    if (auth()->user()->id !== $userId) {
      throw new AppError('Usuário não autorizado', 403);
    }

    $foundUser->delete();
  }
}
