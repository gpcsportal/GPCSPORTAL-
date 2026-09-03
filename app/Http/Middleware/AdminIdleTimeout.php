<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request; use Symfony\Component\HttpFoundation\Response;
class AdminIdleTimeout {public function handle(Request $request,Closure $next): Response {$key='admin_last_activity';$now=now()->timestamp;$last=(int)$request->session()->get($key,$now);$limit=config('gpcs_admin.idle_minutes',30)*60;if($now-$last>$limit){auth()->logout();$request->session()->invalidate();$request->session()->regenerateToken();return redirect('/#login')->with('status','Admin session expired.');}$request->session()->put($key,$now);return $next($request);}}
