<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChuTroMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('chu_tro')->check();
        if($check) {
            $chuTro = Auth::guard('chu_tro')->user();
            if($chuTro->is_open == 0) {
                toastr()->error('Tài khoản của bạn đã bị khóa bởi hệ thống!');
                return redirect('/chu-tro/login');
            }
            return $next($request);
        } else {
            return redirect('/chu-tro/login');
        }
    }
}
