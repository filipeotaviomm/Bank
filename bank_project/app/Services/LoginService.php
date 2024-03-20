<?php

namespace App\Services;

use App\Exceptions\AppError;
// use Illuminate\Support\Facades\Log;

class LoginService
{
  public function execute(array $data)
  {

    // Log::debug('Service login'); //para acompanhar no terminal

    if (!$token = auth()->attempt($data)) {
      throw new AppError('E-mail ou senha incorretos', 401);
    }

    return response()->json([
      'token' => $token,
      'user' => auth()->user()
    ]);

    // return $this->responseToken($token);
  }

  //poderia ser assim também
  // private function responseToken($token)
  // {
  //   return response()->json([
  //     'token' => $token,
  //     'user' => auth()->user()
  //   ]);
  // }
}
