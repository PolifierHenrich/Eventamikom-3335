<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (beranda) user.
     */
    public function index()
    {
        return view('users.welcome');
    }
}