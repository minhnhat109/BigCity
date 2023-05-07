<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
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
    public function viewMyAccount(){
        return view('user.pages_new.my_account');
    }

    public function getDataMyAccount(){
        $user = Auth::guard('user')->user();
        return response()->json([
            'data' => $user
        ]);
    }
    public function viewChangePass(){
        return view('user.pages_new.change_pass');
    }

    public function viewTransaction(){
        return view('user.pages_new.history_tran');
    }

    public function changePassword(ChangePasswordRequest $request) {
        $user = Auth::guard('user')->user();

        if($user){
            $check = Auth::guard('user')->attempt([
                'email'         => $user->email,
                'password'      => $request->old_password
            ]);
            if($check){
                $data = User::find($user->id);
                $data->password = bcrypt($request->password);
                $data->save();
                return response()->json(['status' => 1]);
            }else{
                return response()->json(['status' => 2]);
            }
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function updateInfor(UpdateUserRequest $request) {
        $user = Auth::guard('user')->user();
        $parts = explode(" ", $request->full_name);

        if(count($parts) > 1) {
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);
        }
        else
        {
            $firstname = $request->full_name;
            $lastname = " ";
        }

        if($user){
            $data = User::find($user->id);
            $data->first_name           = $firstname;
            $data->last_name              = $lastname;
            $data->phone_number    = $request->phone_number;
            $data->email            = $request->email;
            $data->save();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }
}
