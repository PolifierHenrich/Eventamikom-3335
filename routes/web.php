//
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'nama' => 'Wijdan Ula Rizki',
        'nim'  => '24.12.3335'
    ]);
});

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