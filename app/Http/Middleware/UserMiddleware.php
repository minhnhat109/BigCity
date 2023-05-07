<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('user')->check();
        if($check) {
            $user = Auth::guard('user')->user();
            if($user->is_open == 0) {
                toastr()->error('Your account has been locked by the system!');
                return redirect('/login');
            }
            return $next($request);
        } else {
            toastr()->success('You need to login!');
            return redirect('/login');
        }
    }
}
