<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
    protected $wish_lists;

    public function __construct()
    {
        $this->wish_lists = new WishList();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist = $this->wish_lists->getAllWishList($user_id);
            return view('users.wishlist', compact('wishlist'));
        } else {
            return redirect()->route('login');
        }
    }

    public function add(Request $request)
    {
        // if(Auth::check())
        // {
            $product_id = $request->input('id');
            $quantity = 1;
            $user_id = Auth()->user()->id;
    
            $existing_wishlist_item = WishList::where('product_id', $product_id)
                ->where('user_id', $user_id)
                ->first();
    
                if ($existing_wishlist_item) {
                    $existing_wishlist_item->delete();
                    return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi danh sách yêu thích.');
                } else {
                $product = Product::find($product_id);
    
                if ($product) {
                    $wishlist_item = new WishList();
                    $wishlist_item->product_id = $product_id;
                    $wishlist_item->user_id = $user_id;
                    
                    $wishlist_item->save();
                    return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào danh sách yêu thích.');
                } else {
                    return redirect()->back()->with('error', 'Không tìm thấy thông tin sản phẩm.');
                }
            }
        }

        public function showWishLists(){

        }



}