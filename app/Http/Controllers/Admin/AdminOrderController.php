<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('orderItems')->get(); // Lấy danh sách đơn hàng cùng với sản phẩm
        return view('dashboard.admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công!');
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id); // Lấy thông tin chi tiết đơn hàng
        return view('dashboard.admin.orders.show', compact('order'));
    }


}
