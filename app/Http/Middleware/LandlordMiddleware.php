<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandlordMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('landlord')->check();
        if($check) {
            $chuTro = Auth::guard('landlord')->user();
            if($chuTro->is_open == 0) {
                toastr()->error('Your account has been locked by the system!');
                return redirect('/landlord/login');
            }
            return $next($request);
        } else {
            toastr()->success('You need to login!');
            return redirect('/landlord/login');
        }
    }
}
