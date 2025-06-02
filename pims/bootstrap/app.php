<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use App\Http\Middleware\CheckEmployeeID;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        // Register middleware aliases
        $middleware->alias([
            'middleware'=>\App\Http\Middleware\Middleware::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'checkUserSession' =>  \App\Http\Middleware\CheckUserSession::class,
        ]);
        
    })
    ->withExceptions(function ($exceptions) {
        // Configure exception handling
    })
    ->create();
