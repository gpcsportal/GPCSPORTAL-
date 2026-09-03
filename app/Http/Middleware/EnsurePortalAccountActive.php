<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request; use Symfony\Component\HttpFoundation\Response;
class EnsurePortalAccountActive {public function handle(Request $request,Closure $next): Response {if(auth()->check()&&!auth()->user()->is_active){auth()->logout();$request->session()->invalidate();$request->session()->regenerateToken();return redirect('/#login')->withErrors(['login'=>'This account is not active.']);}return $next($request);}}
