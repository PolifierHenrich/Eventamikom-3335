<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;

// =====================================================
// TUGAS LAMA (Pertemuan 2 - Routing Dasar)
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
// HALAMAN UTAMA (Pertemuan 3 - Controller & Blade)
// =====================================================

// Halaman Default (Tugas Lama) - tetap seperti aslinya
Route::get('/', function () {
    return view('welcome', [
        'nama' => 'Wijdan Ula Rizki',
        'nim'  => '24.12.3335',
    ]);
});

// Halaman Beranda Event Hub - Menampilkan events dari database (Pertemuan 6)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// =====================================================
// USER AREA (Pertemuan 5 & 6 - Eloquent & Routing)
// =====================================================

// Halaman Detail Event - Dinamis berdasarkan ID
Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');

// Halaman Checkout - GET (tampilkan form)
Route::get('/checkout/{id}', [EventController::class, 'checkout'])->name('checkout');

// Halaman Checkout - POST (Pertemuan 10 - Simpan transaksi)
Route::post('/checkout/{id}', [EventController::class, 'storeCheckout'])->name('checkout.store');

// Halaman E-Ticket (tampilkan tiket berdasarkan order_id)
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');
Route::get('/my-ticket/{orderId}', [EventController::class, 'showTicket'])->name('ticket.show');

// =====================================================
// PERTEMUAN 8 - AUTHENTICATION
// Rute Login & Logout Admin (TANPA middleware - akses bebas)
// =====================================================

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// =====================================================
// ADMIN AREA - Diproteksi Middleware 'admin.auth'
// (Pertemuan 8 - Middleware)
// =====================================================

Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {

    // Dashboard Admin - Statistik dari database (Pertemuan 6)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Event Admin - CRUD lengkap (Pertemuan 5)
    Route::resource('events', AdminEventController::class);

    // Laporan Transaksi (Pertemuan 10 & 12)
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Kelola Kategori - CRUD penuh (Pertemuan 8)
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    // Kelola Partner - CRUD
    Route::resource('partners', PartnerController::class);
});
