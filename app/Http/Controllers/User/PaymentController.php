<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MomoPayment;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momoPayment($id)
    {
        $http = env('APP_URL');
        $user_id = Auth::guard('user')->user()->id;
        $room = Room::find($id);
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán ATM Momo";
        $amount = $room->price > 0  ? $room->price : $room->price;
        $orderId = time() . "";
        $redirectUrl = $http . "/home/thanks";
        $ipnUrl = $http . "/";
        $extraData = "";
        $requestId = time() . "_" . $room->id . "_" . $user_id;
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        // return response([
        //     'link'   => $jsonResult['payUrl'],
        // ]);
        return redirect()->to($jsonResult['payUrl']);

    }

    public function viewThank(){
        $http = env('DB_HOST');
        $db_name = env('DB_DATABASE');
        $con = mysqli_connect($http, "root", "", $db_name);
        if (isset($_GET['partnerCode']) && ($_GET['payType'])) {
            $requestId =  $_GET['requestId'];
            $code_order = rand(0, 9999);
            $partnerCode = $_GET['partnerCode'];
            $orderId = $_GET['orderId'];
            $amount = $_GET['amount'];
            $orderInfo = $_GET['orderInfo'];
            $orderType = $_GET['orderType'];
            $transId = $_GET['transId'] . '_' . time();
            $payType = $_GET['payType'];
            $list = explode('_', $requestId);
            $room_id = $list[1];
            $user_id = $list[2];
            $insert_momo = "INSERT INTO momo_payments(room_id,user_id,partner_code,order_id,amount,order_info,order_type,trans_id,pay_type,code_cart) VALUE('" . $room_id . "','" . $user_id . "','" . $partnerCode . "','" . $orderId . "','" . $amount . "','" . $orderInfo . "','" . $orderType . "','" . $transId . "','" . $payType . "','" . $code_order . "')";
            $cart_query = mysqli_query($con, $insert_momo);
            if ($cart_query) {
                $mess_momo = 'Giao dịch thanh toán bằng MOMO thành công';
            }
        } else {
            $mess_momo = 'Giao dịch thanh toán bằng MOMO thất bại';
        }
        return view('user.pages.thank', compact('mess_momo', 'room_id', 'user_id'));
    }

    public function createPayment(Request $request)
    {
        $user_id = Auth::guard('user')->user()->id;
        $payment_momo = MomoPayment::where('room_id', $request->room_id)
                                    ->where('user_id', $user_id)
                                    ->orderBy('id', 'DESC')
                                    ->first();
        if ($payment_momo) {
            Payment::create([
                
                'room_id' => $request->room_id,
                'user_id' => $user_id,
                'transaction_id' => $payment_momo->trans_id,
                'type' => $request->type_payment,
                'amount' => $payment_momo->amount,
            ]);
            return response()->json([
                'status'  => true
            ]);
        }
        return response()->json([
            'status'  => false
        ]);
    }

    public function getDataTransaction(){
        $user = Auth::guard('user')->user();
        $data = Payment::where("payments.user_id", $user->id)
                    ->join("rooms", "rooms.id", "payments.room_id")
                    ->select("payments.*", "rooms.name")
                    ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
