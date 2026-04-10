<?php

use Illuminate\Support\Facades\Route;

// Route Tugas 1
Route::get('/', function () {
    // Di sinilah kita mengirimkan variabel ke welcome.blade.php
    return view('welcome', [
        'nama' => 'Wijdan Ula Rizki',
        'nim'  => '24.12.3335'
    ]);
});

Route::get('/tentang', function () { 
    return '<h1>Ini adalah Halaman Tentang Aplikasi Event Hub</h1>'; 
}); 

Route::get('/kontak', function(){
    return view('contact');
});

// Route Tugas 2
Route::get('/profil', function () {
    return view('profil');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});