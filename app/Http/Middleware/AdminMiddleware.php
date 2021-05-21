<?php

namespace App\Http\Middleware;

use Closure;
Use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AdminMiddleware
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
        $user_id = Auth::id();
        $role = DB::table('users')->where('id', $user_id)->value('role');
        var_dump($role);
        /**
        foreach($user->roles as $role){
            // ロール値が100(Admin)ならアクセス可能
            if($role->role=='100'){
                return $next($request);
            }else{
            // ロール値が100意外ならアクセス不可能
                abort(404);
            }
        } */
        return $next($request);
    }
}
