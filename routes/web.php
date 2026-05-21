<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;

// =====================================================
// TUGAS LAMA (Pertemuan sebelumnya)
// =====================================================

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/kontak', function () {
    return view('contact');
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

// =====================================================
// HALAMAN UTAMA
// =====================================================

// Halaman Default (Tugas Lama) - ditambahkan data partner & kategori (Soal 4)
Route::get('/', function () {
    $partners   = \App\Models\Partner::latest()->get();
    $categories = \App\Models\Category::all();
    return view('welcome', [
        'nama'       => 'Wijdan Ula Rizki',
        'nim'        => '24.12.3335',
        'partners'   => $partners,
        'categories' => $categories,
    ]);
});

// Halaman Beranda Event Hub (Tugas Baru)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// =====================================================
// USER AREA
// =====================================================

// Halaman Detail Event
Route::get('/event/1', [EventController::class, 'show'])->name('events.show');

// Halaman Checkout
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

// Halaman E-Ticket
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

// =====================================================
// ADMIN AREA
// =====================================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Event Admin - CRUD lengkap (Pertemuan 5)
    Route::resource('events', AdminEventController::class);

    // Laporan Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Kelola Kategori - CRUD lengkap (Soal 1 UTS)
    Route::resource('categories', CategoryController::class);

    // Kelola Partner - CRUD lengkap (Soal 2 UTS)
    Route::resource('partners', PartnerController::class);
});

// =====================================================
// ⚠️ TEMPORARY: Trigger migration di production
// HAPUS SETELAH DIPAKAI!
// =====================================================
Route::get('/run-migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    $migrateOutput = Artisan::output();
    Artisan::call('db:seed', ['--force' => true]);
    $seedOutput = Artisan::output();
    return response('<pre>✅ MIGRATE OUTPUT:<br>' . $migrateOutput . '<br>✅ SEED OUTPUT:<br>' . $seedOutput . '</pre>');
});
