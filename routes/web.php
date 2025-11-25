<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::view('/contact', 'contact')->name('contact');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/theme', [AuthController::class, 'updateTheme'])->name('theme.update');

// Shop
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{item}', [ShopController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ShopController::class, 'viewCart'])->name('shop.cart');
    Route::post('/cart/delete/{item}', [ShopController::class, 'deleteFromCart'])->name('cart.delete');
    Route::post('/buy-now/{item}', [ShopController::class, 'buyNow'])->name('shop.buynow');
    Route::post('/buy-now/{item}/checkout', [ShopController::class, 'singleCheckout'])->name('shop.singleCheckout');
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
    Route::post('/checkout/complete', [ShopController::class, 'completeOrder'])->name('shop.checkout.complete');
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/items', [AdminController::class, 'storeItem'])->name('admin.items.store');
    Route::put('/items/{item}', [AdminController::class, 'updateItem'])->name('admin.items.update');
    Route::delete('/items/{item}', [AdminController::class, 'deleteItem'])->name('admin.items.delete');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::post('/announcements', [AdminController::class, 'storeAnnouncement'])->name('admin.announcements.store');
    Route::delete('/announcements/{announcement}', [AdminController::class, 'deleteAnnouncement'])->name('admin.announcements.delete');
    Route::post('/inbox', [AdminController::class, 'storeInboxMessage'])->name('admin.inbox.store');
    Route::delete('/inbox/{inboxMessage}', [AdminController::class, 'deleteInboxMessage'])->name('admin.inbox.delete');
});
