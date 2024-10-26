<?php

namespace App\Http;

use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

class Kernel extends HttpKernel
{
    protected $middleware = [
        ValidatePostSize::class,
        ConvertEmptyStringsToNull::class,
        HandleCors::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'throttle' => ThrottleRequests::class,
    ];
}
