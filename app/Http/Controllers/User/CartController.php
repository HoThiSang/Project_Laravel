<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;

class CartController extends Controller
{
    protected $carts;
    public function __construct()
    {
        $this->carts = new Cart();
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
        // Lấy thông tin sản phẩm từ request
        $product_id = $request->input('id');
        $quantity = 1; // Số lượng sản phẩm mặc định
        $user_id = 1; // ID của người dùng, bạn có thể thay đổi phần này tùy theo cách bạn xác định người dùng

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng của người dùng hay không
        $existing_cart_item = Cart::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existing_cart_item) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            $existing_cart_item->quantity= $existing_cart_item->quantity+1;
            $existing_cart_item->save();
            return redirect()->back()->with('success', 'Sản phẩm đã được cập nhật trong giỏ hàng.');
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
            $product = Product::find($product_id);

            if ($product) {
                // Tạo mới một mục giỏ hàng
                $cart_item = new Cart();
                $cart_item->product_id = $product_id;
                $cart_item->quantity = $quantity;
                $cart_item->user_id = $user_id;
                $cart_item->price = $product->price; // Giả sử 'price' là một thuộc tính của sản phẩm
                $cart_item->save();
                return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy thông tin sản phẩm.');
            }
        }

    }

    public function showCart()
    {
        $user_id = 1; // Đây là ID của người dùng, bạn có thể thay đổi tùy thuộc vào cách xác định người dùng của bạn
        $carts = Cart::with('product.images')->where('user_id', $user_id)->get();
        return view('users.shopping-cart', compact('carts'));
    }



    public function removeFromCart($id)
    {
        // Tìm sản phẩm trong giỏ hàng có ID là $id
        $cartItem = Cart::where('product_id', $id)->first();

        // Kiểm tra xem sản phẩm có tồn tại không
        if ($cartItem) {
            // Xóa sản phẩm khỏi giỏ hàng
            $cartItem->delete();

            // Chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác
            return redirect()->route('showtocart')->with('success', 'Product removed from cart successfully.');
        } else {
            // Nếu sản phẩm không tồn tại trong giỏ hàng, bạn có thể xử lý theo ý của mình, ví dụ: thông báo lỗi
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
