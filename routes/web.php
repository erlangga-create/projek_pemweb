<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    UserController,
    MenuController,
    ProfileController,
    LokasiController,
    OrderController
};

// Halaman Utama & Autentikasi
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [UserController::class, 'loginform'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/registrasi', [UserController::class, 'registrasiform'])->name('registrasi');
Route::post('/registrasi', [UserController::class, 'registrasi']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::delete('/hapus', [UserController::class, 'destroy'])->name('delete');

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Cart
Route::prefix('cart')->group(function () {
    Route::get('/', [MenuController::class, 'showCart'])->name('cart.index');
    Route::post('add/{id}', [MenuController::class, 'addToCart'])->name('cart.add');
    Route::post('qty/{id}/{action}', [MenuController::class, 'updateQty'])->name('cart.qty');
    Route::post('clear', [MenuController::class, 'clearCart'])->name('cart.clear');
    Route::post('confirm', [MenuController::class, 'confirmCart'])->name('cart.confirm');
    Route::post('order', [MenuController::class, 'storeOrder'])->name('cart.order');
});

// Route order.save agar tidak duplikat, hanya satu saja
Route::post('/order/save', [OrderController::class, 'save'])->name('order.save');

// Route untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Dashboard & Profil
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::delete('/profile/delete', [UserController::class, 'destroy'])->name('delete');

    // Lokasi
    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');
    Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::put('/lokasi/{id}', [LokasiController::class, 'update'])->name('lokasi.update');
    Route::delete('/lokasi/{id}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');
    Route::post('/lokasi/set-default/{id}', [LokasiController::class, 'setDefault'])->name('lokasi.setDefault');

    // Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});