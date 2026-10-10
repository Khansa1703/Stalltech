<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'home'])->name('home');
Route::get('/katalog', [StoreController::class, 'catalog'])->name('catalog');
Route::post('/keranjang/{variant}', [StoreController::class, 'addToCart'])->name('cart.add');
Route::get('/keranjang', [StoreController::class, 'cart'])->name('cart');
Route::put('/keranjang', [StoreController::class, 'updateCart'])->name('cart.update');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register'])->name('register.store');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/pesanan/{order}/pembayaran', [PaymentController::class, 'store'])->name('payments.store');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/produk', [AdminController::class, 'products'])->name('products');
    Route::post('/produk', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::patch('/variasi/{variant}', [AdminController::class, 'updateVariant'])->name('variants.update');
    Route::get('/material', [AdminController::class, 'materials'])->name('materials');
    Route::post('/material', [AdminController::class, 'storeMaterial'])->name('materials.store');
    Route::post('/material/{material}/adjust', [AdminController::class, 'adjustMaterial'])->name('materials.adjust');
    Route::get('/bom/{variant}', [AdminController::class, 'bom'])->name('bom');
    Route::post('/bom/{variant}', [AdminController::class, 'storeBom'])->name('bom.store');
    Route::get('/pesanan', [AdminController::class, 'orders'])->name('orders');
    Route::post('/pesanan/{order}/verifikasi', [OrderController::class, 'verifyPayment'])->name('orders.verify');
    Route::patch('/pesanan/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('/laporan', [AdminController::class, 'reports'])->name('reports');
    Route::get('/laporan/penjualan.csv', [AdminController::class, 'exportSales'])->name('reports.export');
    Route::get('/laporan/penjualan.xls', [AdminController::class, 'exportExcel'])->name('reports.excel');
});
