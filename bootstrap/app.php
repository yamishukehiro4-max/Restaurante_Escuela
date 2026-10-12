<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, $request) {
            // Si es petición API o espera JSON → devolver 401
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'error'   => 'No autenticado.',
                    'message' => 'Enviá: Authorization: Bearer <token>',
                ], 401);
            }
            // Si es web → redirigir al login web
            return redirect('/login');
        });
    })->create();