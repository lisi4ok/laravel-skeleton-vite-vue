<?php

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
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->statefulApi();
        $middleware->throttleApi();

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
//    ->booting(function (Application $application) {
//        if (isset($_ENV['LARAVEL_DATA_PATH'])) {
//            $path = $application->basePath($_ENV['LARAVEL_DATA_PATH']);
//        } elseif (isset($_SERVER['LARAVEL_DATA_PATH'])) {
//            $path = $application->basePath($_SERVER['LARAVEL_DATA_PATH']);
//        } else {
//            $path = $application->basePath('data');
//        }
//        $application->instance('path.data', $path);
//    })
//    ->booted(function (Application $application) {
//        //
//    })
    ->create();
