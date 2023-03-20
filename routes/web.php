<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User authentication routes
Route::group(['prefix' => 'user'], function () {
    // Registration Routes
    Route::get('register', [App\Http\Controllers\UserController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('register', [App\Http\Controllers\UserController::class, 'register'])->name('user.register.submit');

    // Login Routes
    Route::get('login', [App\Http\Controllers\UserController::class, 'showLoginForm'])->name('user.login');
    Route::post('login', [App\Http\Controllers\UserController::class, 'login'])->name('user.login.submit');

    // Logout Route
    Route::post('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('user.logout');
});

// Seller authentication routes
Route::group(['prefix' => 'seller'], function () {
    // Registration Routes
    Route::get('register', 'SellerController@showRegistrationForm')->name('seller.register');
    Route::post('register', 'SellerController@register')->name('seller.register.submit');

    // Login Routes
    Route::get('login', 'SellerController@showLoginForm')->name('seller.login');
    Route::post('login', 'SellerController@login')->name('seller.login.submit');

    // Logout Route
    Route::post('logout', 'SellerController@logout')->name('seller.logout');
});

