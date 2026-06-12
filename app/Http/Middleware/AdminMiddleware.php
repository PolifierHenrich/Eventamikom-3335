<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Pertemuan 8 - Authentication & Middleware
     * Memproteksi halaman admin: hanya user dengan role 'admin' yang boleh masuk.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah user memiliki role admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Halaman ini hanya untuk Administrator.');
        }

        return $next($request);
    }
}
