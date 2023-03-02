<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\CreateAdminRequest;
use App\Http\Requests\Account\UpdateAdminRequest;
use App\Models\Admin;
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
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function index()
    {
        return view('admin.pages.account_admin.index');
    }

    public function checkemail(Request $request)
    {
        if (empty($request->email)) {
            return response()->json([
                'status' => 3,
            ]);
        } else {
            $account = Admin::where('email', $request->email)->first();

            if ($account) {
                return response()->json([
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                ]);
            }
        }
    }

    public function store(CreateAdminRequest $request)
    {
        $data = $request->all();

        $parts = explode(" ", $request->full_name);

        if (count($parts) > 1) {
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);
        } else {
            $firstname = $request->full_name;
            $lastname = " ";
        }

        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;
        $data['password']   = bcrypt($request->password);

        Admin::create($data);
    }

    public function getData()
    {
        $admin = Admin::all();

        return response()->json([
            'data'  => $admin,
        ]);
    }

    public function updateStatus($id)
    {
        $admin = Auth::guard('admin')->user();
        if ($admin->id == $id && $admin->is_open == 1) {
            return response()->json(['status' => 0, 'message' => "You can't lock yourself"]);
        };
        $admin = Admin::find($id);

        if ($admin) {
            $admin->is_open = !$admin->is_open;
            $admin->save();

            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'message'  => 'An error has occurred',
            ]);
        }
    }
    public function edit($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            return response()->json([
                'status'    => true,
                'data'      => $admin,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }

    public function update(UpdateAdminRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        if ($admin->id == $request->id && $request->is_open == 1) {
            return response()->json(['status' => 0, 'message' => "You can't update yourself"]);
        };

        $admin = Admin::find($request->id);

        $parts = explode(" ", $request->full_name);

        if (count($parts) > 1) {
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);
        } else {
            $firstname = $request->full_name;
            $lastname = " ";
        }

        if ($request->password) {
            $data = $request->all();
            $data['first_name']     = $firstname;
            $data['last_name']        = $lastname;
            $data['password']   = bcrypt($request->password);
        } else {
            $admin->first_name       = $firstname;
            $admin->last_name        = $lastname;
            $admin->email            = $request->email;
            $admin->is_open          = $request->is_open;
            $admin->save();
        }
    }
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->delete();

            return response()->json([
                'status'    => true,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
}
