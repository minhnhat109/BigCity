<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\CreateLandlordRequest;
use App\Models\Landlord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandlordController extends Controller
{
    public function viewRegister()
    {
        return view('landlord.pages.auth.register');
    }

    public function actionRegister(CreateLandlordRequest $request)
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
        Landlord::create($data);
    }

    public function viewLogin()
    {
        return view("landlord.pages.auth.login");
    }

    public function actionLogin(Request $request)
    {
        $checkEmail = Auth::guard('landlord')->attempt([
            'email'         => $request->email,
            'password'      => $request->password
        ]);
        if ($checkEmail) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function logout()
    {
        Auth::guard('landlord')->logout();
        return redirect('/landlord/login');
    }
}
