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
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if($admin) {
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
    public function index()
    {
        return view('admin.pages.admin.index');
    }

   public function checkemail(Request $request)
   {
       if(empty($request->email)){
            return response()->json([
                'status' => 3,
            ]);
       } else {
        $account = Admin::where('email', $request->email)->first();

        if($account){
            return response()->json([
                'status' => true,
            ]);
        }else{
             return response()->json([
                 'status' => false,
             ]);
        }
       }
   }

   public function checksdt(Request $request)
   {
        if(empty($request->so_dien_thoai)){
            return response()->json([
                'status' => 3,
            ]);
    } else {
            $account = Admin::where('so_dien_thoai', $request->so_dien_thoai)->first();

            if($account){
                return response()->json([
                    'status' => true,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                ]);
            }
        }
   }

   public function checkmaadmin(Request $request)
   {
        $account = Admin::where('ma_admin', $request->ma_admin)->first();

        if($account){
            return response()->json([
                'status' => true,
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
   }

    public function store(CreateAdminRequest $request)
    {
        $data = $request->all();

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

        $data['ho_lot']     = $firstname;
        $data['ten']        = $lastname;
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
        $login_id = Auth::guard('admin')->user();
        if($login_id->id == $id && $login_id->is_block == 0) {
            return response()->json(['status' => 0, 'message' => 'Bạn không thể tự khóa']);
        };
        $admin = Admin::find($id);

        if($admin) {
            $admin->is_block = !$admin->is_block;
            $admin->save();

            return response()->json([
                'status'  => true,
            ]);

        } else {
            return response()->json([
                'message'  => 'Đã có lôi xảy ra',
            ]);
        }
    }

    public function viewLogin()
    {
        return view("admin.pages.auth.login");
    }

    public function actionLogin(Request $request)
    {
        // dd($request->username);
        $checkEmail = Auth::guard('admin')->attempt([
            'email'         => $request->username,
            'password'      => $request->password]);
        $checkPhone = Auth::guard('admin')->attempt([
            'so_dien_thoai' => $request->username,
            'password'      => $request->password]);
        if($checkEmail || $checkPhone){
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

    public function edit($id)
    {
        $admin = Admin::find($id);  // trả về 1 object
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
        $login_id = Auth::guard('admin')->user();
        if($login_id->id == $request->id && $request->is_block == 1) {
            return response()->json(['status' => 0, 'message' => 'Bạn không thể tự khóa']);
        };

        $admin = Admin::find($request->id);

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

        if($request->password) {
            $data = $request->all();
            $data['ho_lot']     = $firstname;
            $data['ten']        = $lastname;
            $data['password']   = bcrypt($request->password);
        }else{
            $admin->ho_lot                  = $firstname;
            $admin->ten                     = $lastname;
            $admin->ma_admin                = $request->ma_admin;
            $admin->email                   = $request->email;
            $admin->so_dien_thoai           = $request->so_dien_thoai;
            $admin->gioi_tinh               = $request->gioi_tinh;
            $admin->is_master               = $request->is_master;
            $admin->is_block                = $request->is_block;

            $admin->save();
        }
    }
}
