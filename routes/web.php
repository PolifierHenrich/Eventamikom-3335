<?php

use Illuminate\Support\Facades\Artisan;

// ⚠️ TEMPORARY: Route untuk trigger migration di production - HAPUS SETELAH DIPAKAI
Route::get('/run-migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    $migrateOutput = Artisan::output();
    Artisan::call('db:seed', ['--force' => true]);
    $seedOutput = Artisan::output();
    return response('<pre>MIGRATE:<br>'.$migrateOutput.'<br>SEED:<br>'.$seedOutput.'</pre>');
});


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

// Halaman Default (Tugas Lama)
Route::get('/', function () {
    return view('welcome', [
        'nama' => 'Wijdan Ula Rizki',
        'nim'  => '24.12.3335',
    ]);
});

// Halaman Beranda Event Hub (Tugas Baru)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Halaman Detail Event
Route::get('/event/1', [EventController::class, 'show'])->name('events.show');

// Halaman Checkout
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

// Halaman E-Ticket
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Event Admin - CRUD lengkap (Pertemuan 5)
    Route::resource('events', AdminEventController::class);

    // Laporan Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Kelola Kategori (Latihan Tugas Pertemuan 3)
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
});
