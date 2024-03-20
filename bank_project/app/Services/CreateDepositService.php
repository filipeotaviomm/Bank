<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;


class CreateDepositService
{
  public function execute(string $userId, float $value)
  {
    $foundUser = User::find($userId);

    if (is_null($foundUser)) {
      throw new AppError('Usuário não encontrado', 404);
    }

    $foundUser->balance += $value;
    $foundUser->save();

    return $foundUser;
  }
}
