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
        // Kiểm tra xem bản ghi có tồn tại hay không
        $order = Order::find($id);
        if (!$order) {
            // Nếu không tìm thấy, có thể redirect hoặc hiển thị thông báo lỗi
            return redirect()->route('admin-orders-delete')->with('error', 'Order not found.');
        }

        // Nếu bản ghi tồn tại, thực hiện xóa
        $order->delete();

        // Sau khi xóa, có thể redirect hoặc hiển thị lại view
        return redirect()->route('admin-orders-delete', ['id' => $order->id])->with('success', 'Order deleted successfully.');
    }
}
