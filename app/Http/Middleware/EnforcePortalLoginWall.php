<?php

namespace App\Http\Middleware;

use App\Services\PortalSettingsService;
use App\Support\SafePortalRedirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforcePortalLoginWall
{
    public function __construct(
        private readonly PortalSettingsService $settings
    ) {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if (! $this->settings->loginWallEnabled()) {
                return $next($request);
            }

            if ($request->expectsJson() || $request->is('api/*') || $request->is('metadata/*')) {
                return response()->json([
                    'message' => 'This account is not active. Please contact the Admin.',
                ], 401);
            }

            return redirect('/#login')
                ->withErrors(['login' => 'This account is not active.']);
        }

        if (! $this->settings->loginWallEnabled()) {
            return $next($request);
        }

        if ($user) {
            return $next($request);
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
