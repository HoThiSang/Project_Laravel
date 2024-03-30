<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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


                    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                    date_default_timezone_set('Asia/Ho_Chi_Minh');

                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = "http://127.0.0.1:8000/is-checkout-success";
                    $vnp_TmnCode = 'X1WL3I2L';
                    $vnp_HashSecret = "SFBDIRUMYOSNUZGWWYKVLQSKEDOSOXWY";

                    $vnp_TxnRef = rand(00, 9999);

                    $vnp_OrderInfo = "Noi dung thanh toan";
                    $vnp_OrderType = "billpayment";
                    $total = $request->total_price;
                    $vnp_Amount = 20000 * 100;
                    $vnp_Locale = "vn";
                    $vnp_BankCode = "NCB";
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    $phone = $request->phone;
                    $email = $request->email;
                    $username = $request->username;
                    $address = $request->address;
                    $vnp_Bill_Mobile = $phone;
                    $vnp_Bill_Email = $email;
                    $vnp_User_Id = $request->user_id;
                    $fullName = trim($username);
                    if (isset($fullName) && trim($fullName) != '') {
                        $name = explode(' ', $fullName);
                        $vnp_Bill_FirstName = array_shift($name);
                        $vnp_Bill_LastName = array_pop($name);
                    }
                    $vnp_address = trim($address);
                    $dataInfor = ['user_id' => $vnp_User_Id, 'username' => $vnp_Bill_FirstName . $vnp_Bill_LastName, 'phone' => $vnp_Bill_Mobile, 'email' => $vnp_Bill_Email, 'address' => $vnp_address];
                    Session::put('user_info', $dataInfor);
                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_TxnRef" => $vnp_TxnRef,
                        "vnp_Bill_Mobile" => $vnp_Bill_Mobile, // Thêm thông tin khách hàng vào URL
                        "vnp_Bill_Email" => $vnp_Bill_Email,
                        'vnp_Bill_FirstName' => $vnp_Bill_FirstName,
                        'vnp_Bill_LastName' => 'vnp_Bill_LastName'


                    );

                    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                        $inputData['vnp_BankCode'] = $vnp_BankCode;
                    }


                    //var_dump($inputData);
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }

                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash =   hash_hmac('sha512', $hashdata, getenv('VNP_HASHSECRET')); //  
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }
                    // return response()->json($vnp_Url);
                    $returnData = array(
                        'code' => '00', 'message' => 'success', 'data' => $vnp_Url
                    );
                    if (isset($_POST['redirect'])) {
                        header('Location: ' . $vnp_Url);
                        die();
                    } else {
                        echo json_encode($returnData);
                    }
                }
            }
        }
    }

    public function isCheckout()
    {

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);

        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }


        $secureHash = hash_hmac('sha512', $hashData, getenv('VNP_HASHSECRET'));
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $userInfo = User::find(1);

                $order = new Order();
                $order->order_date = $inputData['vnp_PayDate'];
                $order->address = $userInfo->address;
                $order->phone_number = $userInfo->phone;
                $order->payment_method = $inputData['vnp_BankCode'];
                $order->order_status = 'Ordered';
                $order->deliver_id = 1;
                $order->created_at = now();
                $order->order_total = $inputData['vnp_Amount'];
                $order->user_id = $userInfo->id;
                $order->save();
                if ($order) {

                    $message = 'Giao dịch thành công!';
                    return view('users/checkout-success', compact('order', 'message'));
                } else {

                    $error = 'Đã xảy ra lỗi khi lưu đơn hàng.';
                    return view('users/checkout-failded', compact('error'));
                }
            } else {

                $error = 'Giao dịch không thành công.';
                return view('users/checkout-failded', compact('error'));
            }
        } else {

            $error = 'Chữ ký không hợp lệ.';
            return view('users/checkout-failded', compact('error'));
        }
    }


    public function getAllOrder($user_id = null)
    {
        $check = "failed";
        if (Session::has('loginId')) {
            $user_id = Session::get('loginId');
            $orderAll = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->where('user_id', $user_id)
                ->get();
            $check = "success";
            return view('users/order-list', compact('orderAll', 'check'));
        }
        return view('users/order-list');
    }
}
