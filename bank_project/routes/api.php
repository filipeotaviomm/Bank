<?php

use App\Http\Controllers\{UserController, AuthController};
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);

//o jwt.verify é um apelido dado ao middleware JWTMiddlware em app/Http/kernel.php
Route::middleware('jwt.verify')->group(function () {
  Route::post('/users/{id}/deposits', [UserController::class, 'deposit']);
});
