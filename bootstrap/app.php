<?php

use App\Http\Middleware\AdminIdleTimeout;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsurePortalAccountActive;
use App\Http\Middleware\SecurityHeaders;
use App\Support\SafePortalRedirect;
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
        $middleware->trustProxies(
            at: '*',
            headers:
                Request::HEADER_X_FORWARDED_FOR |
                Request::HEADER_X_FORWARDED_HOST |
                Request::HEADER_X_FORWARDED_PORT |
                Request::HEADER_X_FORWARDED_PROTO |
                Request::HEADER_X_FORWARDED_PREFIX
        );

        // The public landing page contains the portal sign-in UI. When a guest
        // reaches a protected browser route, remember only a sanitized local
        // path and send them to that sign-in UI. JSON/API requests still receive
        // Laravel's normal unauthenticated JSON response.
        $middleware->redirectGuestsTo(function (Request $request): string {
            $intended = SafePortalRedirect::sanitize($request->getRequestUri(), '/');

            if ($request->hasSession()) {
                $request->session()->put('url.intended', $intended);
            }

            return SafePortalRedirect::loginUrl($intended);
        });

        $middleware->append(SecurityHeaders::class);

        $middleware->alias([
            'admin' => EnsureAdmin::class,
            'admin.idle' => AdminIdleTimeout::class,
            'account.active' => EnsurePortalAccountActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Keep API/metadata failures machine-readable even when the browser does
        // not send an explicit application/json Accept header. Laravel still
        // owns status-code mapping and hides exception details in production.
        $exceptions->shouldRenderJsonWhen(
            static fn (Request $request, \Throwable $exception): bool =>
                $request->expectsJson()
                || $request->is('api/*')
                || $request->is('metadata/*')
                || $request->is('auth/status')
        );
    })
    ->create();
