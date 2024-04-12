<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
class AdminWishListController extends Controller
{
    public function showWishLists()
    {
        $wishLists = WishList::with('user', 'product')->get();
        return view('admin/wish-lists/admin-wish-lists', compact('wishLists'));
    }
}
