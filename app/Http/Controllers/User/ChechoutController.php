<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ChechoutController extends Controller
{

    public function index()
    {

        $user = User::all()->where('id', 1);
        $carts = Cart::select('products.product_name', 'carts.price as cart_price', 'carts.quantity', 'products.price', 'products.id as product_id')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->get();
        // dd($cartItems);
        return view('users/checkout', compact('carts', 'user'));
    }

    public function checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'username' => 'required',
                'email' => 'required|email|regex:/^.+@.+$/i',
                'phone' => 'required|regex:/^\d{10}$/',
                'address' => 'required',
            ];
            $messages = [
                'email.required' => 'The email field is must required',
                'email.regex' => 'Invalid email format.',
                'phone.required' => 'The phone field is must required',
                'phone.regex' => 'Phone number must be 10 digits.',
                'address.required' => 'The address field is must required'
            ];

            $validateData = Validator::make($request->all(), $rules, $messages);

            if ($validateData->fails()) {
                return redirect()->back()->withErrors($validateData);
            } else {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $vnp_TmnCode = "X1WL3I2L"; //Mã định danh merchant kết nối (Terminal Id)
                    $vnp_HashSecret = "SFBDIRUMYOSNUZGWWYKVLQSKEDOSOXWY"; //Secret key
                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
                    $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
                    $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

                    $vnp_RequestId = rand(1,10000); // Mã truy vấn
            $vnp_Command = "querydr"; // Mã api
            $vnp_TxnRef = $_POST["txnRef"]; // Mã tham chiếu của giao dịch
            $vnp_OrderInfo = "Query transaction"; // Mô tả thông tin
            //$vnp_TransactionNo= ; // Tuỳ chọn, Mã giao dịch thanh toán của CTT VNPAY
            $vnp_TransactionDate = $_POST["transactionDate"]; // Thời gian ghi nhận giao dịch
            $vnp_CreateDate = date('YmdHis'); // Thời gian phát sinh request
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của máy chủ thực hiện gọi API


            $datarq = array(
                "vnp_RequestId" => $vnp_RequestId,
                "vnp_Version" => "2.1.0", 
                "vnp_Command" => $vnp_Command,
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                //$vnp_TransactionNo= ; 
                "vnp_TransactionDate" => $vnp_TransactionDate,
                "vnp_CreateDate" => $vnp_CreateDate,
                "vnp_IpAddr" => $vnp_IpAddr
            );

            $format = '%s|%s|%s|%s|%s|%s|%s|%s|%s';

            $dataHash = sprintf(
                $format,
                $datarq['vnp_RequestId'], //1
                $datarq['vnp_Version'], //2
                $datarq['vnp_Command'], //3
                $datarq['vnp_TmnCode'], //4
                $datarq['vnp_TxnRef'], //5
                $datarq['vnp_TransactionDate'], //6
                $datarq['vnp_CreateDate'], //7
                $datarq['vnp_IpAddr'], //8
                $datarq['vnp_OrderInfo']//9
            ); 

            $checksum = hash_hmac('SHA512', $dataHash, $vnp_HashSecret);
            $datarq["vnp_SecureHash"] = $checksum;
       //     $txnData = callAPI_auth("POST", $apiUrl, json_encode($datarq));
            $ispTxn = json_decode($txnData, true);

               
                }
            }
        }
    }
}
