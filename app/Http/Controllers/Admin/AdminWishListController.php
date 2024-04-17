<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
class AdminWishListController extends Controller
{
    protected $wish_lists;
    public function __construct()
    {
        $this->wish_lists= new WishList();
    }

    public function showWishLists()
    {
        $wishLists = WishList::with('user', 'product')->whereNull('wish_lists.deleted_at')->get();
        return view('admin/wish-lists/admin-wish-lists', compact('wishLists'));
    }

    public function destroy($id)
    {

        if (!empty($id)) {
            $wish_list = $this->wish_lists->deleteWishListById($id);
            return redirect()->back()->with('success', 'Whist list deleted successfully');
        }
        return redirect()->back()->with('error', 'Product deleted fields');
    }
}
