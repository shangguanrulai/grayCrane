<?php

namespace App\Http\Middleware;

use App\Model\Admin_User;
use Closure;

class hasRole
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
//        1.获取当前正在访问的路由
//        $route = $request;
        $route = \Route::current()->getActionName();

//       2. 获取到当前用户应有的角色(为禁用的角色)


        $roles = Admin_User::find(session('user')->id)->role()->where('role_status',0)->get();


//       3. 获取当前用户拥有的权限

        $arr = [];
        foreach($roles as $v){
           $perms = $v->permission;
           foreach($perms as $a){
               if($a->status==0){
                   $arr[]=$a->urls;
               }

           }
        }

//       4. 去掉重复的权限
            $arr = array_unique($arr);

//        5.判断单签路由是否在数组里
        if(in_array($route,$arr)){
            return $next($request);
        }else{
            return redirect('/noaccess');
        }

    }
}
