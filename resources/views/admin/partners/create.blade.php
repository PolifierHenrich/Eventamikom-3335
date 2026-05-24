@extends('layouts.admin')

@section('title', 'Tambah Partner - Admin')
@section('page_title', 'Tambah Partner')
@section('page_subtitle', 'Isi form berikut untuk menambahkan partner baru.')

@section('content')

<div class="max-w-xl">
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10">
        <form action="{{ route('admin.partners.store') }}" method="POST">
            @csrf

            {{-- Nama Partner --}}
            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                    Nama Partner <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Google, Microsoft, Tokopedia..."
                       class="w-full px-5 py-3 rounded-xl border @error('name') border-rose-400 bg-rose-50 @else border-slate-200 @enderror focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                @error('name')
                    <p class="mt-2 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Logo URL --}}
            <div class="mb-8">
                <label for="logo_url" class="block text-sm font-bold text-slate-700 mb-2">
                    URL Logo <span class="text-slate-400 font-normal">(opsional)</span>
                </label>
                <input type="url"
                       id="logo_url"
                       name="logo_url"
                       value="{{ old('logo_url') }}"
                       placeholder="https://example.com/logo.png"
                       class="w-full px-5 py-3 rounded-xl border @error('logo_url') border-rose-400 bg-rose-50 @else border-slate-200 @enderror focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                @error('logo_url')
                    <p class="mt-2 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-xs text-slate-400">Masukkan URL gambar logo partner (format: https://...)</p>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 active:scale-95 transition">
                    Simpan Partner
                </button>
                <a href="{{ route('admin.partners.index') }}"
                   class="px-6 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
