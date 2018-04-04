<?php

namespace App\Http\Middleware;

use App\Model\Config;
use Closure;

class Gray
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
        $status = config('webconfig.web_status');

        if($status == 0){
            return response()->view('home.gray');
        } else if($status == 1){
            return $next($request);
        }

    }
}
