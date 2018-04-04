<?php

namespace App\Http\Middleware;

use Closure;


class Admin_login
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
        if(Session()->get('user_admin')){
            return $next($request);
        }else{
            return redirect('/login')->with('msg','请先登录');
        }

    }
}
