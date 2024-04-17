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
    public function OrderDelete($id)
    {
      
        $order = Order::find($id);
        if (!$order) {
  
            return redirect()->route('admin-order')->with('error', 'Order not found.');
        }

        $order->delete();


        return redirect()->route('admin-order')->with('success', 'Order deleted successfully.');
    }

    public function OrderEdit($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin/orders/admin-update-order', compact('order'));
    }


    public function OrderUpdate(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $user = $order->user;
        $user->update(['username' => $request->input('username')]);

        $order->update([
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'payment_method' => $request->input('payment_method'),
        ]);

        return redirect()->route('admin-order')->with('success', 'Order updated successfully');
    }

    public function changeStatus(Request $request, $id)
    {
     
        $order = Order::findOrFail($id);

        $order->order_status = $request->input('new_status');
        $order->save();
        return redirect()->route('admin-order')->with('success', 'Order status changed successfully');
    }
}
