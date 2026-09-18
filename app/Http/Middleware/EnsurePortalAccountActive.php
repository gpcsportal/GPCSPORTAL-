<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePortalAccountActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && ! auth()->user()->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if (
                $request->expectsJson()
                || $request->is('api/*')
                || $request->is('metadata/*')
            ) {
                return response()->json([
                    'message' => 'This account is not active. Please contact the Admin.',
                ], 401);
            }

            return redirect('/#login')
                ->withErrors(['login' => 'This account is not active.']);
        }

        return $next($request);
    }
}
