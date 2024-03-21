<?php

use App\Http\Controllers\{UserController, AuthController, TransactionController};
use Illuminate\Support\Facades\Route;

//users
Route::post('/users', [UserController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);
//o jwt.verify é um apelido dado ao middleware JWTMiddlware em app/Http/kernel.php
Route::middleware('jwt.verify')->group(function () {
  Route::get('/users/{id}', [UserController::class, 'readUser']);
  Route::get('/users', [UserController::class, 'readUsers']);
  Route::patch('/users/{id}', [UserController::class, 'updateUser']);
  Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
});



Route::middleware('jwt.verify')->group(function () {
  Route::post('/users/{id}/deposits', [UserController::class, 'deposit']);
  Route::post('/transactions', [TransactionController::class, 'create']);
});
