<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        web: __DIR__.'/../routes/web.php',
    )
    ->withProviders([
        App\Providers\AppServiceProvider::class,
        App\Providers\RepositoryServiceProvider::class,
        App\Providers\EventServiceProvider::class,
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        });

        $exceptions->render(function (AuthenticationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.',
            ], 401);
        });

        $exceptions->render(function (ModelNotFoundException|NotFoundHttpException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found.',
            ], 404);
        });

        $exceptions->render(function (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error.',
            ], 500);
        });
    })
    ->create();
