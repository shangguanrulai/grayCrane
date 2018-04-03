<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
	
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
