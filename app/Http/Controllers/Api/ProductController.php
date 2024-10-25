<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm
        return response()->json($products); // Trả về dưới dạng JSON
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json($product);
    }
}
