 <?php

use App\Http\Middleware\AdminIdleTimeout;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsurePortalAccountActive;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Railway / Cloud Proxy Trust
        |--------------------------------------------------------------------------
        |
        | Railway terminates HTTPS before forwarding the request to Laravel.
        | Trusting the forwarded headers allows Laravel to correctly recognise
        | HTTPS, the original host, and the original request scheme.
        |
        | This is important for secure session cookies and CSRF protection.
        |
        */

        $middleware->trustProxies(
            at: '*',
            headers:
                Request::HEADER_X_FORWARDED_FOR |
                Request::HEADER_X_FORWARDED_HOST |
                Request::HEADER_X_FORWARDED_PORT |
                Request::HEADER_X_FORWARDED_PROTO |
                Request::HEADER_X_FORWARDED_PREFIX
        );

        /*
        |--------------------------------------------------------------------------
        | Application Middleware Aliases
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'admin' => EnsureAdmin::class,
            'admin.idle' => AdminIdleTimeout::class,
            'account.active' => EnsurePortalAccountActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /*
         * Laravel's normal production exception handling is used.
         * Keep APP_DEBUG=false on Railway.
         */
    })
    ->create();
