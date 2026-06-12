<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Menampilkan daftar semua partner.
     */
    public function index()
    {
        $partners = Partner::latest()->paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Form tambah partner baru.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Simpan partner baru ke database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'logo_url'    => 'nullable|url|max:500',
            'website_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
        ]);

        Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Data partner berhasil ditambahkan.');
    }

    /**
     * Form edit partner.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Simpan perubahan data partner.
     */
    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'logo_url'    => 'nullable|url|max:500',
            'website_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
        ]);

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Data partner berhasil diperbarui.');
    }

    /**
     * Hapus partner dari database.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Data partner berhasil dihapus.');
    }
}
