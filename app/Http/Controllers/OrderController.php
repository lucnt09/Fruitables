<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $cart = session()->get('cart');
        $total = $this->calculateTotal($cart);
        $hideBanner = true;

        // Kiểm tra nếu giỏ hàng trống
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn trống!');
        }

        // Tính tổng tiền giỏ hàng
        $total = $this->calculateTotal($cart);

        return view('layouts.order', compact('cart', 'total', 'categories', 'hideBanner'));
    }


    public function checkout(Request $request)
    {
        $request->validate([
            'paymentMethod' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000'
        ]);

        $user = Auth::user();
        $cart = session()->get('cart');

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'notes' => $request->notes,
            'total' => $this->calculateTotal($cart),
            'payment_method' => $request->paymentMethod,
            'status' => 'Chờ xác nhận',  // Trạng thái mặc định
        ]);

        // Lưu từng sản phẩm trong giỏ hàng vào bảng order_items
        foreach ($cart as $productId => $item) {
            if (is_array($item) && isset($item['id'])) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'], // Sử dụng giá từ item
                ]);
            }
        }

        // Xóa giỏ hàng sau khi thanh toán
        session()->forget('cart');

        return redirect()->route('order.success', $order->id)->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    // Tính tổng tiền
    private function calculateTotal($cart)
    {
        $total = 0;

        // Kiểm tra nếu giỏ hàng rỗng
        if (empty($cart)) {
            return "Giỏ hàng trống. Vui lòng thêm sản phẩm!";
        }

        foreach ($cart as $key => $item) {
            // Bỏ qua phần tử "count"
            if ($key === 'count') {
                continue;
            }

            // Kiểm tra nếu phần tử là mảng và có các khóa cần thiết
            if (is_array($item) && isset($item['quantity'], $item['price'])) {
                $price = (float) $item['price'];
                $quantity = (int) $item['quantity'];

                $total += $quantity * $price;
            } else {
                return 0;
            }
        }

        return $total;
    }

    public function orderSuccess($orderId)
    {
        $categories = Category::all();
        $order = Order::with('orderItems.product')->find($orderId);
        $hideBanner = true;

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng.');
        }

        return view('layouts.success', compact('order', 'categories'))->with('hideBanner', true);
    }

    public function myOrders()
    {
        $categories = Category::all();
        $orders = Auth::user()->orders()->with('orderItems.product')->get();
        return view('layouts.orderlist', compact('orders', 'categories'));
    }
}
