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

    public function OrderEdit($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin/orders/admin-update-order', compact('order'));
    }


    public function OrderUpdate(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Cập nhật thông tin người dùng
        $user = $order->user;
        $user->update(['username' => $request->input('username')]);

        // Cập nhật các thông tin khác của đơn hàng trong bảng 'orders'
        $order->update([
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'payment_method' => $request->input('payment_method'),
            // Nếu cần cập nhật các trường khác của đơn hàng, thêm chúng ở đây
        ]);

        return redirect()->route('admin-order')->with('success', 'Order updated successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        // Lấy đơn hàng từ cơ sở dữ liệu
        $order = Order::findOrFail($id);

        // Cập nhật trạng thái mới từ dữ liệu được gửi từ form
        $order->order_status = $request->input('new_status');
        $order->save();

        // Chuyển hướng lại hoặc thực hiện các thao tác cần thiết sau khi cập nhật trạng thái
        return redirect()->route('admin-order')->with('success', 'Order status changed successfully');
    }
}
