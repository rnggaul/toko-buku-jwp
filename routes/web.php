<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;

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

    // Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index'); 

    // profil
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/ubah-password', [ProfileController::class, 'password'])->name('profile.password');
    Route::put('/ubah-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
