<?php

use App\Exceptions\Profile\ProfileNotFoundException;
use App\Exceptions\User\InvalidUserCredentialsException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (InvalidUserCredentialsException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 401);
        });
        $exceptions->render(function (ProfileNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 404);
        });
    })->create();
