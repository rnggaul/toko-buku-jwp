<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class); 
    Route::resource('users', \App\Http\Controllers\UserController::class); 

    // Stok Barang
    Route::get('/persediaan-barang', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/persediaan-barang/transaksi', [InventoryController::class, 'storeTransaction'])->name('inventory.transaction.store');

    // Lamporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index'); 
});
