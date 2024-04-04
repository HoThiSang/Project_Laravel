<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use App\Models\Product;
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
            $product_id = $request->input('product_id');
            if(Product::find($product_id))
            {
                $wish = new WishList();
                $wish->product_id = $product_id;
                $wish->user_id = 1;
                $wish->save();
                return response()->json(['status'=> "Product Added to Wishlist"]);
            }
            else {
                return response()->json(['status'=> "Product doesn't exist"]);
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
