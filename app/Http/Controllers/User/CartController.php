<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $carts;
    protected $product;
    public function __construct()
    {
        $this->carts = new Cart();
        $this->product = new Product();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth()->check()) {
            $product_id = $request->input('id');
            $quantity = 1;
            $user_id = Auth()->user()->id;

            $existing_cart_item = Cart::where('product_id', $product_id)
                ->where('user_id', $user_id)
                ->first();
            if ($existing_cart_item) {
                $existing_cart_item->quantity = $existing_cart_item->quantity + 1;
                $existing_cart_item->save();
                return redirect()->back()->with('success', 'Sản phẩm đã được cập nhật trong giỏ hàng.');
            } else {
                $product = $this->product->getProductByIDs( $product_id );

                if ($product) {
                    $cart_item = new Cart();
                    $cart_item->product_id = $product_id;
                    $cart_item->quantity = $quantity;
                    $cart_item->user_id =  $user_id ;
                    $cart_item->price = $product->discounted_price;
                    $cart_item->unit_price = $product->price;
                    $cart_item->save();
                    return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
                } else {
                    return redirect()->back()->with('error', 'Không tìm thấy thông tin sản phẩm.');
                }
            }
        }else{
            return redirect()->back()->with('error', 'Not found user');
        }
    }

    public function showCart()
    {
        $check = 'error';
        if (Auth()->check()) {
            $user_id = Auth::id();
            $carts = $this->carts->getAllCarts($user_id);
            $check = 'success';

            return view('users.shopping-cart', compact('carts', 'check'));
        }
        return view('users.shopping-cart', compact('check'));
    }

    public function removeFromCart($id)
    {

        $cartItem = Cart::where('product_id', $id)->first();
        if ($cartItem) {

            $cartItem->delete();

            return redirect()->route('showtocart')->with('success', 'Product removed from cart successfully.');
        } else {
            return redirect()->route('showtocart')->with('error', 'Product not found in cart.');
        }
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
