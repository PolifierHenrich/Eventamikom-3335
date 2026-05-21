<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // Tampilkan halaman publik dengan data partner dan kategori
    public function index()
    {
        $partners   = Partner::latest()->get();
        $categories = Category::all();

        return view('welcome', [
            'nama'       => 'Wijdan Ula Rizki',
            'nim'        => '24.12.3335',
            'partners'   => $partners,
            'categories' => $categories,
        ]);
    }
}
