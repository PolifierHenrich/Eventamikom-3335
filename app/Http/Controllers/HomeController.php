<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (beranda) user dengan daftar event dari database.
     * Implementasi Pertemuan 6: Relationship Eloquent & Filter Data
     */
    public function index()
    {
        // Ambil semua event beserta relasi kategori, urut terbaru, limit 6
        $events = Event::with('category')
            ->latest()
            ->take(6)
            ->get();

        return view('users.welcome', compact('events'));
    }
}