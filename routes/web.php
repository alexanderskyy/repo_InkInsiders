<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Middleware\UserOnly;

/*
|--------------------------------------------------------------------------
| Public Routes (Frontend)
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Shop Pages
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/collections', [ShopController::class, 'collections'])->name('shop.collections');
Route::get('/bundles', [ShopController::class, 'bundles'])->name('shop.bundles');
Route::get('/limited', [ShopController::class, 'limited'])->name('shop.limited');

// Static Pages
Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/faq', function () {
    return view('frontend.faq');
})->name('faq');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');

Route::get('/sustainability', function () {
    return view('frontend.sustainability');
})->name('sustainability');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout Routes (PERBAIKAN DI SINI)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/mark-paid/{order}', [CheckoutController::class, 'markAsPaid'])->name('checkout.mark-paid');
    Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Backend)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('orders', AdminOrderController::class)
        ->only(['index', 'show', 'destroy']);

    Route::patch('orders/{order}/status',
        [AdminOrderController::class, 'updateStatus']
    )->name('orders.updateStatus');
});