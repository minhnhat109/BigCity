<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function viewLogin()
    {
        return view("admin.pages.auth.login");
    }

    public function actionLogin(Request $request)
    {
        $checkEmail = Auth::guard('admin')->attempt([
            'email'         => $request->email,
            'password'      => $request->password]);
        if($checkEmail) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
