<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\FacebookSocialiteController;
use App\Http\Controllers\LinkedinSocialiteController;
use App\Http\Controllers\GithubSocialiteController;
use App\Http\Controllers\XmlParserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ReviewController;

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

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

Route::get('auth/facebook', [FacebookSocialiteController::class, 'redirectToFB']);
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleCallback']);

Route::get('auth/linkedin', [LinkedinSocialiteController::class, 'redirectToLinkedin']);
Route::get('callback/linkedin', [LinkedinSocialiteController::class, 'handleCallback']);

Route::get('auth/github', [GithubSocialiteController::class, 'redirectToGithub']);
Route::get('callback/github', [GithubSocialiteController::class, 'handleCallback']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get("item-data", [XmlParserController::class, "parseXml"]);

Route::get('/categories/{category}/products', [ProductController::class, 'index']);
Route::get('/categories/{category}/search', [ProductController::class, 'search']);

Route::post('/products/{productId}/addToCart', [ProductController::class, 'addToCart'])->name('products.addToCart');
Route::post('/products/{productId}/removeFromCart', [ProductController::class, 'removeFromCart'])->name('products.removeFromCart');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{productId}', [CartController::class, 'removeItem'])->name('cart.removeItem');

Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/create/{productId}', [ReviewController::class, 'index'])->name('reviews.create');
