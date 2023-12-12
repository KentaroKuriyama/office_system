<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //管理者でないユーザーの機能管理ページへの遷移を許可しない
        if (Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)) {
            return $next($request);
        }

        // ロールが1または2でない場合のリダイレクトなどの処理
        return redirect('/')->with('error', 'アクセス権限がありません');
    }
}
