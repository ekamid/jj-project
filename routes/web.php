<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('home');
});


Route::group(['as' => 'frontend.'], function () {
    Route::get('find-stores', [HomeController::class, 'find_stores'])->name('find_stores');
    Route::get('get-stores', [HomeController::class, 'get_stores'])->name('get_stores');
    Route::get('get-stores/{id}', [HomeController::class, 'find_single_store'])->name('find_single_store');
});



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name("dashboard");
        Route::get('/products', [AdminController::class, 'products'])->name("products");

        Route::get('/stores', [AdminController::class, 'stores'])->name("stores");
        Route::match(['GET', 'POST'], '/add-store', [AdminController::class, 'add_store'])->name("add_store");
        Route::match(['GET', 'POST'], '/edit-store/{id}', [AdminController::class, 'edit_store'])->name("edit_store");
        Route::post('/delete-store/{id}', [AdminController::class, 'delete_store'])->name("delete_store");


        Route::post("/logout", [AdminController::class, "logout"])->name("logout");
    });

    Route::match(['GET', 'POST'], '/login', [AdminController::class, 'login'])->name('login');
});



require __DIR__ . '/auth.php';
