<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Di sinilah kita mengirimkan variabel ke welcome.blade.php
    return view('welcome', [
        'nama' => 'Wijdan Ula Rizki',
        'nim'  => '24.12.3335'
    ]);
});