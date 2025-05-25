<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    UserController,
    MenuController,
    ProfileController,
    LokasiController
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
Route::get('/cart', [MenuController::class, 'showCart'])->name('cart.index');
Route::post('/cart/add/{id}', [MenuController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/qty/{id}/{action}', [MenuController::class, 'updateQty'])->name('cart.qty');
Route::post('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/confirm', [MenuController::class, 'confirmCart'])->name('cart.confirm');
Route::post('/cart/order', [MenuController::class, 'storeOrder'])->name('cart.order');

// Hanya untuk user yang login
Route::middleware(['auth'])->group(function () {
    // Dashboard & Profil
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::delete('/profile/delete', [UserController::class, 'destroy'])->name('delete');

    // Lokasi
    Route::get('/lokasi', [HomeController::class, 'lokasi'])->name('lokasi');
    // Route::resource('/lokasi', LokasiController::class)->except(['show']);
    Route::post('/lokasi', [LokasiController::class, 'store']);
});
