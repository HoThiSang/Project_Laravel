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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist = WishList::where('user_id', Auth::id())->get();
        return view('users/wishlist', compact('wishlist'));
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
        // else {
        //     return response()->json(['status'=>"Login to Continue"]);
        // }
    // }

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
        //
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