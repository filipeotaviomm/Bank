<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Transaction;
use App\Models\User;


class CreateTransactionService
{
  public function execute(array $data)
  {
    $userPayer = $this->findUser($data['payer_id']);

    if ($userPayer->type === 'SELLER') {
      throw new AppError('Esse usuário não pode realizar pagamentos', 403);
    }

    if ($userPayer->id === $data['payee_id']) {
      throw new AppError('Você não pode fazer depósito para você mesmo', 403);
    }

    if ($userPayer->balance < $data['value']) {
      throw new AppError('Você não tem saldo suficiente', 403);
    }

    $userPayer->balance -= $data['value'];
    $userPayer->save();

    $userPayee = $this->findUser($data['payee_id']);

    $userPayee->balance += $data['value'];
    $userPayee->save();

    return Transaction::create([
      'payer_id' => $userPayer->id,
      'payee_id' => $userPayee->id,
      'value' => $data['value']
    ]);
  }

  private function findUser(string $userId)
  {
    $user = User::find($userId);

    if (is_null($user)) {
      throw new AppError("Usuário {$userId} não encontrado", 404);
    }

    return $user;
  }
}
