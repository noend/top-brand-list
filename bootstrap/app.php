<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(using: function (Exceptions $exceptions) {
        $exceptions->render(function ( Exception $e, Request $request) {

            if ($request->is('api/*')) {
                return match (true) {
                    $e instanceof AuthenticationException => response()->json([
                        'success' => false,
                        'message' => 'Unauthorized Request.',
                    ], Response::HTTP_UNAUTHORIZED),

                    $e instanceof ValidationException => response()->json([
                        'success' => false,
                        'message' => 'Validation failed.',
                        'errors' => $e->errors(),
                    ], Response::HTTP_UNPROCESSABLE_ENTITY),

                    $e instanceof ModelNotFoundException,
                    $e instanceof NotFoundHttpException => response()->json([
                        'success' => false,
                        'message' => 'Resource not found.',
                    ], Response::HTTP_NOT_FOUND),

                    $e instanceof HttpException => response()->json([
                        'success' => false,
                        'message' => $e->getMessage(),
                    ], $e->getStatusCode()),

                    $e instanceof RouteNotFoundException => response()->json([
                        'success' => false,
                        'message' => 'Route not found.',
                    ], Response::HTTP_NOT_FOUND),

                    default => (function () use ($e) {
                        Log::error($e);
                        $message = app()->hasDebugModeEnabled()
                            ? $e->getMessage()
                            : 'An unexpected error occurred.';
                        return response()->json([
                            'success' => false,
                            'message' => $message,
                        ], Response::HTTP_INTERNAL_SERVER_ERROR);
                    })(),
                };
            }
            return $request->expectsJson();
        });
    })->create();
