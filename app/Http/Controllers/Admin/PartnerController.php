<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    // Tampilkan daftar partner + pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');

        $partners = Partner::when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.partners.index', compact('partners', 'search'));
    }

    // Form tambah partner
    public function create()
    {
        return view('admin.partners.create');
    }

    // Simpan partner baru
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'logo'  => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Partner::create([
            'name'     => $request->name,
            'logo_url' => $logoPath,
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan.');
    }

    // Form edit partner
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    // Perbarui data partner
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'logo'  => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $logoPath = $partner->logo_url;
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($partner->logo_url) {
                Storage::disk('public')->delete($partner->logo_url);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $partner->update([
            'name'     => $request->name,
            'logo_url' => $logoPath,
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil diperbarui.');
    }

    // Hapus partner
    public function destroy(Partner $partner)
    {
        // Hapus file logo dari storage jika ada
        if ($partner->logo_url) {
            Storage::disk('public')->delete($partner->logo_url);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus.');
    }
}
