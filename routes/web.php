<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/tentang', function () { 
    return view('tentang'); 
});

Route::get('/kontak', function(){
    return view('contact'); // Mengarah ke file contact.blade.php
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});

// Halaman Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Detail Event
Route::get('/event/1', [EventController::class, 'show'])->name('events.show');

// Halaman Checkout
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

// Halaman E-Ticket
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Event Admin
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');

    // Laporan Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Kelola Kategori (Latihan Tugas Pertemuan 3)
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
});
