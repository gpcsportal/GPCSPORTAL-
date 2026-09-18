<?php

namespace App\Http\Middleware;

use App\Services\PortalSettingsService;
use App\Support\SafePortalRedirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforcePortalLoginWall
{
    public function handle(Request $request, Closure $next, PortalSettingsService $settings): Response
    {
        if (! $settings->loginWallEnabled()) {
            return $next($request);
        }

        $user = $request->user();

        if ($user && $user->is_active) {
            return $next($request);
        }

        if ($user && ! $user->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($request->expectsJson() || $request->is('api/*') || $request->is('metadata/*')) {
            return response()->json([
                'message' => 'Please sign in to access this portal content.',
            ], 401);
        }

        $intended = SafePortalRedirect::sanitize($request->getRequestUri(), '/');
        if ($request->hasSession()) {
            $request->session()->put('url.intended', $intended);
        }

        return redirect(SafePortalRedirect::loginUrl($intended));
    }
}
