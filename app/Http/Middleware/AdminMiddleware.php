<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('admin')->check();
        if($check) {
            $admin = Auth::guard('admin')->user();
            if($admin->is_open == 0) {
                toastr()->error('Tài khoản của bạn đã bị khóa bởi hệ thống!');
                return redirect('/admin/login');
            }
            return $next($request);
        } else {
            toastr()->error('Bạn cần phải đăng nhập!');
            return redirect('/admin/login');
        }
    }
}
