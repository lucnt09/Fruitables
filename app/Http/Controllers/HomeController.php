<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::orderByDesc('id')->paginate(12);
        $hots = Product::orderByDesc('id')->paginate(6);
        $categories = Category::all();
        return view('index', compact('products', 'hots', 'categories'));
    }

    public function showCategoryProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->orderByDesc('id')->paginate(10);
        $categories = Category::all();

        return view('layouts.cateproduct', compact('products', 'categories', 'category'))->with('hideBanner', true);
    }

    public function show($id)
    {
        $categories = Category::all();
        $product = Product::with('category')->findOrFail($id);

        // Lấy các sản phẩm liên quan (cùng danh mục, trừ sản phẩm hiện tại)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('layouts.detailproduct', compact('product', 'categories', 'relatedProducts'))->with('hideBanner', true);
    }

    public function about()
    {
        $categories = Category::all();

        return view('layouts.about', compact('categories'))->with('hideBanner', true);
    }

    public function contact()
    {
        $categories = Category::all();

        return view('layouts.contact', compact('categories'))->with('hideBanner', true);
    }
}
