<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Menampilkan halaman detail event (sisi user).
     */
    public function show()
    {
        return view('users.event-detail');
    }

    /**
     * Menampilkan halaman checkout.
     */
    public function checkout()
    {
        return view('users.checkout');
    }

    /**
     * Menampilkan halaman e-ticket setelah pembayaran.
     */
    public function ticket()
    {
        return view('users.ticket');
    }

    /**
     * Menampilkan halaman kelola event di panel Admin.
     */
    public function indexAdmin()
    {
        return view('admin.events');
    }
}