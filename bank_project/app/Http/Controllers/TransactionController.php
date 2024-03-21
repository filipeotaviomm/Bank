<?php

namespace App\Http\Controllers; //quase todos arquivos tem que ter isso com o caminho

use App\Http\Requests\CreateTransactionRequest;
use App\Services\CreateTransactionService;


class TransactionController extends Controller
{
  public function create(CreateTransactionRequest $request)
  {
    $createTransactionService = new CreateTransactionService();

    return $createTransactionService->execute($request->all());
  }
}
