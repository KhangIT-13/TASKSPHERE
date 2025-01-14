<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        // Kiểm tra xem người dùng đã đăng nhập và có vai trò 'admin' không
        if (Auth::check() && Auth::user()->Role == 'Admin') {
            return $next($request);
        }
        return redirect()->route('auth.accessdenied');


    }
}
