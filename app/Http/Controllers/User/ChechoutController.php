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
            'address.required'=> 'The address field is must required'
        ];

        $validateData = Validator::make($request->all(), $rules, $messages);

        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData);
        } else {
            $order = new Order();
            $order->order_date = now();
            $order->address= $request->address;
            $order->phone_number= $request->phone;
            $order->payment_method = $request->payment_method;
            $order->order_status = 'Ordered';
            $order->deliver_id = 1;
            $order->created_at = now();
            $order->order_total = $request->total_price;
           $order->save();
        }
    }
}

}
