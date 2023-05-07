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
                toastr()->success('Your account has been locked by the system!');
                return redirect('/admin/login');
            }
            return $next($request);
        } else {
            toastr()->success('You need to login!');
            return redirect('/admin/login');
        }
    }
}
