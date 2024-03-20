<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use Illuminate\Http\Request;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\{TokenInvalidException, TokenExpiredException};
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    try {
      JWTAuth::parseToken()->authenticate();
      return $next($request);
    } catch (JWTException $error) {

      if ($error->getMessage() === 'The token could not be parsed from the request') {
        throw new AppError('Token não fornecido', 400);
      }

      if ($error instanceof TokenExpiredException) {
        throw new AppError('Token expirado', 401);
      }

      if ($error instanceof TokenInvalidException) {
        throw new AppError('Token inválido', 498);
      }



      throw new AppError($error->getMessage(), 500);
    }
  }
}
