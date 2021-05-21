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
        if($role=='100'){
            // ロール値が100(admin)ならアクセス可能
            return $next($request);
        }else{
            // それ以外はアクセス不可
            abort(403);
        }
        return $next($request);
    }
}
