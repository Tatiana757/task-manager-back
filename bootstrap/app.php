<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('admin')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([
            'auth.admin' => \App\Http\Middleware\AuthenticateAdmin::class,
            'guest.admin' => \App\Http\Middleware\RedirectIfAuthenticatedAdmin::class,
            'api.auth' => \App\Http\Middleware\AuthenticateApi::class,
        ]);

        $middleware->appendToGroup('admin', [
            Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $middleware->appendToGroup('api', [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
        $exceptions->render(function (Throwable $e, Request $request){
            if ($request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'error' => [
                            'message' => 'Validation failed',
                            'errors' => $e->errors()
                        ]
                    ], 422);
                }

                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'error' => [
                            'message' => 'Unauthorized'
                        ]
                    ], 401);
                }

                if ($e instanceof ModelNotFoundException) {
                    $model = class_basename($e->getModel());
                    return response()->json([
                        'error' => [
                            'message' => "{$model} not found"
                        ]
                    ], 404);
                }

                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'error' => [
                            'message' => 'Route not found'
                        ]
                    ], 404);
                }
            }
        });

    })
    ->create();
