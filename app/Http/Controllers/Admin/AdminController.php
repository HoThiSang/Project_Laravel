<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
class AdminController extends Controller
{
    public function __construct(){
       $this->middleware('alreadyLoggedIn');
    }
    
    public function index(){
       
            $order = new Order();
            $orderCount = $order->countOrders();
            $user = new User();
            $userCount = $user->countUser();
            $product = new Product();
            $productCount = $product->countProduct();
            $category = new Categories();
            $categoryCount = $category->countCategory();
        return view('admin.dashboard', compact('orderCount','userCount', 'productCount', 'productCount', 'categoryCount'));
    }
}
