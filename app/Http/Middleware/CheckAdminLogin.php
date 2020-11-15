<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLogin
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
        // ユーザー登録しているかどうか確認
        if (!auth() ->guard('admin') -> check()){
            return redirect(route('front.login')) -> withErrors(['error' => 'ログインしてくだい']);
        }

        return $next($request);
    }
}
