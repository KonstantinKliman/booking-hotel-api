<?php

use App\Exceptions\Profile\ProfileAlreadyExistsException;
use App\Exceptions\Profile\ProfileNotFoundException;
use App\Exceptions\User\EmailIsNotVerifiedException;
use App\Exceptions\User\ExpiredEmailVerificationTokenException;
use App\Exceptions\User\FailedEmailVerificationTokenException;
use App\Exceptions\User\InvalidEmailVerificationTokenException;
use App\Exceptions\User\InvalidUserCredentialsException;
use App\Http\Middleware\CheckBookingOwnership;
use App\Http\Middleware\CheckEmailIsVerifiedMiddleware;
use App\Http\Middleware\CheckHotelOwnership;
use App\Http\Middleware\CheckRoomOwnership;
use App\Http\Middleware\CheckUserRoleIsCustomerMiddleware;
use App\Http\Middleware\CheckUserRoleIsOwnerMiddleware;
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
        $middleware->alias([
            'verified-email' => CheckEmailIsVerifiedMiddleware::class,
            'owner-role' => CheckUserRoleIsOwnerMiddleware::class,
            'customer-role' => CheckUserRoleIsCustomerMiddleware::class,
            'check-hotel-ownership' => CheckHotelOwnership::class,
            'check-room-ownership' => CheckRoomOwnership::class,
            'check-booking-ownership' => CheckBookingOwnership::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (InvalidUserCredentialsException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 401);
        });
        $exceptions->render(function (InvalidEmailVerificationTokenException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 404);
        });
        $exceptions->render(function (ExpiredEmailVerificationTokenException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 401);
        });
        $exceptions->render(function (FailedEmailVerificationTokenException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 400);
        });
        $exceptions->render(function (EmailIsNotVerifiedException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 401);
        });
        $exceptions->render(function (ProfileNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 404);
        });
        $exceptions->render(function (ProfileAlreadyExistsException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'profile' => $e->getProfile()
            ], 409);
        });
    })->create();
