<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function showCart()
    {
        $categories = Category::all();
        $cart = session()->get('cart', []);
        $products = [];
        $totalQuantity = 0; // Khởi tạo biến để lưu tổng số lượng sản phẩm trong giỏ hàng

        // Lặp qua từng sản phẩm trong giỏ hàng để lấy thông tin chi tiết
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $products[$productId] = [
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'image' => $product->image,
                    'name' => $product->name,
                    'id' => $product->id,
                ];
                $totalQuantity += $item['quantity']; // Cộng dồn số lượng sản phẩm
            }
        }

        // Cập nhật số lượng sản phẩm vào session
        session()->put('cart.count', $totalQuantity);

        return view('layouts.cart', compact('products', 'categories', 'totalQuantity'))->with('hideBanner', true);
    }
    public function add(Request $request)
    {
        $productId = $request->input('product_id'); // Lấy ID sản phẩm từ request
        $quantity = $request->input('quantity', 1); // Lấy số lượng, mặc định là 1

        // Gọi phương thức để thêm sản phẩm vào giỏ hàng
        $this->addToCart($productId, $quantity);


        $count = session()->get('cart.count');
        return response()->json(['count' => $count]);
    }

    public function decrease($id)
    {
        // Gọi phương thức để giảm số lượng sản phẩm trong giỏ hàng
        $this->decreaseQuantity($id);

        return redirect()->back()->with('success', 'Số lượng sản phẩm đã giảm.');
    }

    public function total()
    {
        // Tính tổng tiền trong giỏ hàng
        $total = $this->calculateTotal();

        return response()->json(['total' => $total]); // Trả về tổng tiền dưới dạng JSON
    }

    private function addToCart($productId, $quantity)
    {
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session
        $product = Product::find($productId); // Tìm sản phẩm trong database theo ID

        if ($product) {
            // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                // Nếu chưa có, thêm sản phẩm mới vào giỏ hàng
                $cart[$productId] = [
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'image' => $product->image,
                    'name' => $product->name,
                    'id' => $product->id,
                ];
            }
            session()->put('cart', $cart);
            // Cập nhật số lượng sản phẩm vào session
            $totalProductCart = session()->get('cart.count');


            session()->put('cart.count', $totalProductCart+1);


        }
    }
    private function decreaseQuantity($productId)
    {
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session
        if (isset($cart[$productId])) {
            // Nếu số lượng sản phẩm lớn hơn 1, giảm số lượng
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            } else {
                // Nếu số lượng bằng 1, xóa sản phẩm khỏi giỏ hàng
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
        }
    }

    private function calculateTotal()
    {
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session
        $total = 0; // Khởi tạo tổng tiền

        // Tính tổng tiền dựa trên số lượng và giá của từng sản phẩm
        foreach ($cart as $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $total += $item['price'] * $item['quantity'];
            }
        }

        return $total; // Trả về tổng tiền
    }

    public function remove($productId)
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm có trong giỏ hàng không
        if (isset($cart[$productId])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$productId]);

            session()->put('cart', $cart);

            // Tính lại tổng tiền sau khi xóa sản phẩm
            $total = $this->calculateTotal(); // Tính lại tổng
            session()->put('cart.total', (float)$total); // Cập nhật lại tổng vào session

            // Nếu giỏ hàng rỗng, xóa giỏ hàng khỏi session
            if (empty($cart)) {
                session()->forget('cart'); // Xóa giỏ hàng khỏi session
                session()->forget('cart.total'); // Xóa tổng tiền khỏi session
                session()->put('cart.count', 0); // Đặt số lượng giỏ hàng về 0
                return redirect()->back()->with('success', 'Giỏ hàng đã trống.');
            }

            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }
}
