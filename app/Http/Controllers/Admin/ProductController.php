<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_FOLDER = 'dashboard.admin.products.';

    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->paginate(10);
        return view(self::PATH_FOLDER . __FUNCTION__, compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view(self::PATH_FOLDER . __FUNCTION__, compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'image' => $image,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view(self::PATH_FOLDER . __FUNCTION__, compact('product', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|nullable',
            'price' => 'required',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Cập nhật thông tin sản phẩm
        $product->name = $request->name;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->category_id = $request->category_id;

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Lưu ảnh mới
            $filename = $request->file('image')->store('products', 'public');
            $product->image = $filename;
        }

        // Lưu sản phẩm
        $product->save();

        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã bị xóa!');
    }
}
