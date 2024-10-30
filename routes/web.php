<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Kiểm tra nếu người dùng đã đăng nhập và chuyển hướng dựa trên loại người dùng
    if (Auth::user()) {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('dashboard.admin.master');
        }
        return redirect()->route('dashboard.user');
    }

    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    return redirect()->route('login');
})->name('home');

Auth::routes();
Route::group(['middleware' => ['auth', 'active']], function () {
    // Chuyển hướng động dựa trên vai trò sau khi đăng nhập
    Route::get('/dashboard', function () {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('dashboard.admin.master');
        }
        return redirect()->route('dashboard.user');
    })->name('dashboard');

    Route::get('/shop', [HomeController::class, 'index'])->name('dashboard.user');
    Route::get('/category/{id}', [HomeController::class, 'showCategoryProducts'])->name('category.products');
    Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::get('/cart/total', [CartController::class, 'total'])->name('cart.total');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/checkout', [OrderController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::get('/order-success/{id}', [OrderController::class, 'orderSuccess'])->name('order.success');
        Route::get('/order-details/{id}', [OrderController::class, 'show'])->name('order.details');

        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my-orders');

    });



    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.admin.master');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

        Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::put('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    });
});
