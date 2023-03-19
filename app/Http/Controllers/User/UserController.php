<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function viewRegister()
    {
        return view('user.pages.auth.register');
    }

    public function actionRegister(CreateUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $parts = explode(" ", $request->full_name);
        if (count($parts) > 1) {
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);
        } else {
            $firstname = $request->full_name;
            $lastname = " ";
        }
        $data['first_name']     = $firstname;
        $data['last_name']        = $lastname;
        User::create($data);
    }

    public function viewLogin()
    {
        return view("user.pages.auth.login");
    }

    public function actionLogin(Request $request)
    {
        $check = Auth::guard('user')->attempt([
            'email'         => $request->email,
            'password'      => $request->password
        ]);
        if ($check) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/login');
    }
}
