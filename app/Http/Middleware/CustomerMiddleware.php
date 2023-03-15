<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('user')->check();
        if($check) {
            $user = Auth::guard('user')->user();
            if($user->is_open == 0) {
                toastr()->error('Tài khoản của bạn chưa được kích hoạt !');
                return redirect('/');
            }
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
