<?php

namespace App\Http\Middleware;

use Closure;

class Home_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('user')) {
            return $next($request);
        } else {
            return redirect('home/login')->with('errors','请先登录');
        }
    }
}
