<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            // Web middleware group
        ],
        'api' => [
            // API middleware group
        ],
    ];

    protected $routeMiddleware = [
        // Route specific middleware
        'auth' => \App\Http\Middleware\Authenticate::class,
        'api_key' => \App\Http\Middleware\CheckApiKey::class, // Your custom middleware
        // other middleware
    ];
}
