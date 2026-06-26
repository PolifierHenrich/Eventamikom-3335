<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;

// =====================================================
// TUGAS LAMA (Pertemuan 2)
// =====================================================
Route::get('/tentang', fn() => view('tentang'));
Route::get('/kontak',  fn() => view('contact'));
Route::get('/profil',  fn() => view('profil'));
Route::get('/katalog', fn() => view('katalog'));
Route::get('/bantuan', fn() => view('bantuan'));

// =====================================================
// HALAMAN UTAMA
// =====================================================
Route::get('/', function () {
    return view('welcome', [
        'nama' => 'Wijdan Ula Rizki',
        'nim'  => '24.12.3335',
    ]);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// =====================================================
// USER AREA — Event & Checkout
// =====================================================
Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');

// Checkout menggunakan CheckoutController (Pertemuan 11 - Midtrans)
Route::get('/checkout/{id}',  [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');

// Halaman Pembayaran Midtrans Snap (Pertemuan 11)
Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])->name('checkout.payment');

// Halaman Sukses Pembayaran (Pertemuan 11)
Route::get('/success/{order_id}', [CheckoutController::class, 'success'])->name('checkout.success');

// Halaman E-Ticket
Route::get('/my-ticket',          [EventController::class, 'ticket'])->name('ticket');
Route::get('/my-ticket/{orderId}',[EventController::class, 'showTicket'])->name('ticket.show');

// =====================================================
// AUTHENTICATION
// =====================================================
Route::get('/admin/login',  [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout',[LoginController::class, 'logout'])->name('admin.logout');

// =====================================================
// ADMIN AREA
// =====================================================
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::resource('categories', CategoryController::class)->only(['index','store','update','destroy']);
    Route::resource('partners', PartnerController::class);
});