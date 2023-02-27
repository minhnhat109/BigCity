<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChuTro\changePasswordRequest;
use App\Http\Requests\ChuTro\CreateDangKyChuTroRequest;
use App\Http\Requests\ChuTro\UpdateChuTroRequest;
use App\Jobs\sendMailActiveJob;
use App\Models\Bill_detail;
use App\Models\ChuTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandlordController extends Controller
{
    public function viewSignUp()
    {
        return view('chu_tro.sign_up');
    }

    public function viewLogin()
    {
        return view('chu_tro.login');
    }

    public function logout()
    {
        Auth::guard('chu_tro')->logout();
        return redirect('/chu-tro/login');
    }


    public function index()
    {
        return view('admin.pages.chu_tro.index');
    }

    public function viewPayment()
    {
        $chuTro = Auth::guard('chu_tro')->user();

        $viewPayment = Bill_detail::join('them_moi_phong_tros','bill_details.id_phong','them_moi_phong_tros.id')
                                ->join('customers','bill_details.id_customer','customers.id')
                                ->where('id_chu_tro',$chuTro->id)
                                ->select('them_moi_phong_tros.*','customers.*','bill_details.id_done')
                                ->get();
        // dd($viewPayment->toArray());
        return view('chu_tro.pages.payment.view_payment',compact('viewPayment'));
    }

    public function store(CreateDangKyChuTroRequest $request)
    {
        $hash = str()::uuid()->toString();
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['hash'] = $hash;
        $link = env('APP_URL') . '/chu-tro/kich-hoat/' . $hash;
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
        $chu_tro = ChuTro::latest()->first();
        if ($chu_tro) {
            $data['ma_chu_tro'] = 'CT'. (10000 + $chu_tro->id);
        } else {
            $data['ma_chu_tro'] = 'CT10000';
        }
        $data['ho_lot']     = $firstname;
        $data['ten']        = $lastname;
        $data['password']   = bcrypt($request->password);


        // Mail::to($request->email)->send(new CustomerAcitveMail($request->full_name, $link));
        sendMailActiveJob::dispatch($request->full_name, $link, $request->email);

        ChuTro::create($data);
    }


    public function getData()
    {
        $chuTro = ChuTro::all();
        return response()->json([
            'data'  => $chuTro,
        ]);

    }


    public function actionLogin(Request $request)
    {
        $data = $request->all();

        $login = Auth::guard('chu_tro')->attempt($data);
        if($login){
            $chuTro = Auth::guard('chu_tro')->user();
            if($chuTro->is_active == 1) {
                return response()->json(['status' => 4]);
            }else{
                Auth::guard('chu_tro')->logout();
                return response()->json(['status' => 5]);
            }
        }else{
            return response()->json(['status' => 0]);
        }


        // $checkEmail = Auth::guard('chu_tro')->attempt([
        //     'email'         => $request->email,
        //     'password'      => $request->password]);
        // $checkPhone = Auth::guard('chu_tro')->attempt([
        //     'so_dien_thoai' => $request->email,
        //     'password'      => $request->password]);
        // if($checkEmail || $checkPhone){
        //     $user = Auth::guard('chu_tro')->user();
        //     if ($user->is_block == 1) {
        //         Auth::guard('chu_tro')->logout();
        //         return response()->json(['status' => 3]);
        //     }else {
        //         return response()->json(['status' => 1]);
        //     }
        // } else {
        //     return response()->json(['status' => 2]);
        // }
    }

    public function updateStatus($id)
    {

        $admin = ChuTro::find($id);

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

    public function active($hash)
    {
        $chuTro = ChuTro::where('hash', $hash)->first();
        if($chuTro) {
            if($chuTro->is_active == 1){
                toastr()->warning("Tài Khoản Đã Được Kích Hoạt Trước Đó");
            }else{
                toastr()->success("Email " . $chuTro->email . " đã được kích hoạt");
                $chuTro->is_active = 1;
                $chuTro->save();
            }
        }else {
            toastr()->error("Mã kích hoạt không tồn tại");
        }
        return redirect('/chu-tro/login');
    }

    public function destroy($id)
    {
        $chuTro = ChuTro::find($id);
        if ($chuTro) {
            $chuTro->delete();

            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'status'  => false,
            ]);
        }
    }

    public function indexUpdate()
    {
        return view("chu_tro.pages.edit_chu_tro.index");
    }

    public function edit()
    {
       $chu_tro = Auth::guard('chu_tro')->user();

       $data = ChuTro::find($chu_tro->id);

       return response()->json([
            'data' => $data,
       ]);
    }
    public function update(UpdateChuTroRequest $request)
    {
        $user = Auth::guard('chu_tro')->user();
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

        if($user){
            $data = ChuTro::find($user->id);
            $data->ho_lot           = $firstname;
            $data->ten              = $lastname;
            $data->so_dien_thoai    = $request->so_dien_thoai;
            $data->email            = $request->email;
            $data->gioi_tinh        = $request->gioi_tinh;
            $data->cmnd_cccd        = $request->cmnd_cccd;
            $data->dia_chi          = $request->dia_chi;
            $data->ngay_sinh        = $request->ngay_sinh;
            $data->hinh_anh         = $request->hinh_anh;
            $data->save();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }

    }

    public function changePassword(changePasswordRequest $request)
    {
        $user = Auth::guard('chu_tro')->user();
        if($user){
            $data = ChuTro::find($user->id);
            $data->password = bcrypt($request->password);
            $data->save();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }

    }
}
