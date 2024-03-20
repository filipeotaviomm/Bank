<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    //esse método trata o retorno do insomnia
    public function render($request, Throwable $error)
    {

        if ($error instanceof ValidationException) {
            return response()->json(['error' => $error->validator->errors()], 422);
        }

        if ($error instanceof AppError) {
            return response()->json(
                ['error' => $error->getMessage()],
                $error->getCode()
            );
        }

        Log::error('Internal', [$error]);

        if ($error instanceof AuthorizationException) {
            return response()->json(
                ['error' => 'Usuário não autorizado'],
                403
            );
        }

        if ($error instanceof NotFoundHttpException) {
            return response()->json(
                ['error' => 'Rota não encontrada'],
                404
            );
        }

        return response()->json([
            'message' => "Ocorreu um erro interno no servidor"
        ], 500);
    }
}
