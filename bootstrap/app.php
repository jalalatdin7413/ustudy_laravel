<?php

use App\Http\Middleware\HasVerifiedEmail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
            'verified' => HasVerifiedEmail::class,
        ]);
        $middleware->group('api', [
            \App\Http\Middleware\ApiJson::class,
        ]); 
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $ex) {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => $ex->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        });

        $exceptions->render(function (AuthorizationException $ex) {
            return response()->json([
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $ex->getMessage()
            ], Response::HTTP_FORBIDDEN);
        });

        $exceptions->render(function (HttpException $ex) {
            return response()->json([
                'status' => $ex->getStatusCode(),
                'message' => $ex->getMessage()
            ], $ex->getStatusCode());
        });

        $exceptions->render(function (\Throwable $ex) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })->create();
