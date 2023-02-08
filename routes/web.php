<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home_index'])->name('home');


Route::group(['as' => 'frontend.'], function () {

    Route::get('shop', [HomeController::class, 'shop_index'])->name('shop');
    Route::get('cart', [HomeController::class, 'cart_index'])->name('cart');
    Route::get('product/{slug}', [HomeController::class, 'product_details'])->name('product_details');
    Route::get('products/{id}', [HomeController::class, 'check_product_stock'])->name('check_product_stock');

    Route::get('checkout', [OrderController::class, 'checkout_index'])->name('checkout');
    Route::post('place-order', [OrderController::class, 'place_order'])->name('place_order');
    Route::get('order/invoice/{order_code}', [OrderController::class, 'order_invoice'])->name('order_invoice');

    Route::get('find-stores', [HomeController::class, 'find_stores'])->name('find_stores');
    Route::get('get-stores', [HomeController::class, 'get_stores'])->name('get_stores');
    Route::get('get-stores/{id}', [HomeController::class, 'find_single_store'])->name('find_single_store');


    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('user/orders', [OrderController::class, 'index'])->name('user.orders');
    Route::get('user/orders/{order_code}', [OrderController::class, 'order_details'])->name('user.order_details');
    Route::match(['GET', 'POST'], 'user/edit', [UserController::class, 'edit'])->name("user.edit");

    Route::get("queries", [UserController::class, 'queries'])->name('user.queries');
    Route::match(['GET', 'POST'], "queries/{id}", [UserController::class, 'query_chat'])->name('user.queries.chat');
    Route::match(['GET', 'POST'], "queries/add", [UserController::class, 'create_query'])->name('user.queries.add');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name("dashboard");
        Route::get('/products', [AdminController::class, 'products'])->name("products");

        // categories 
        Route::get('/categories', [AdminController::class, 'categories'])->name("categories");
        Route::match(['GET', 'POST'], '/add-category', [AdminController::class, 'add_category'])->name("add_category");
        Route::match(['GET', 'POST'], '/edit-category/{id}', [AdminController::class, 'edit_category'])->name("edit_category");
        Route::post('/delete-category/{id}', [AdminController::class, 'delete_category'])->name("delete_category");

        // products 
        Route::get('/products', [ProductController::class, 'index'])->name("products.index");
        Route::match(['GET', 'POST'], '/product/add', [ProductController::class, 'add_product'])->name("products.add");
        Route::match(['GET', 'POST'], '/product/edit/{id}', [ProductController::class, 'edit_product'])->name("products.edit");
        Route::post('/product/delete/{id}', [ProductController::class, 'delete_product'])->name("products.delete");

        // users 
        Route::get('/users', [AdminController::class, 'users'])->name("users.index");
        Route::post('/user/delete/{id}', [AdminController::class, 'delete_user'])->name("users.delete");

        // orders 
        Route::get('/orders', [AdminController::class, 'orders'])->name("orders.index");
        Route::get('/orders/{order_code}', [AdminController::class, 'order_details'])->name('orders.details');
        Route::POST('/orders/status-update/{id}', [AdminController::class, 'order_status_update'])->name('orders.order_status_update');



        //stores
        Route::get('/stores', [StoreController::class, 'index'])->name("stores.index");
        Route::match(['GET', 'POST'], '/store/add', [StoreController::class, 'add_store'])->name("stores.add");
        Route::match(['GET', 'POST'], '/store/edit/{id}', [StoreController::class, 'edit_store'])->name("stores.edit");
        Route::post('/store/delete/{id}', [StoreController::class, 'delete_store'])->name("stores.delete");


        Route::post("/logout", [AdminController::class, "logout"])->name("logout");
    });

    Route::match(['GET', 'POST'], '/login', [AdminController::class, 'login'])->name('login');
});



require __DIR__ . '/auth.php';
