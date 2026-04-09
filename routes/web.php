<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mahasiswa', function () {
    return response()->json([
        'nama' => 'Wijdan Ula Rizki',
        'nim'  => '24.12.3335',
    ]);
});
