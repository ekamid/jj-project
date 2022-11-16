<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name("dashboard");
        Route::post("/logout", [AdminController::class, "logout"])->name("logout");
    });

    Route::match(['GET', 'POST'], '/login', [AdminController::class, 'login'])->name('login');
});



require __DIR__ . '/auth.php';