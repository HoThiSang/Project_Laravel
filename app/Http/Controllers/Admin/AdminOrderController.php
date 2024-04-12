<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class AdminOrderController extends Controller
{
    public function showOrder()
    {
        $orders = Order::all();
        return view('admin/orders/admin-order', compact('orders'));
    }
}
