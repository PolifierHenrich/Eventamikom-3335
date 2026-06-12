@extends('layouts.admin')

@section('title', 'Edit Partner - Admin')
@section('page_title', 'Edit Partner')
@section('page_subtitle', 'Perbarui informasi mitra atau sponsor.')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Partner --}}
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2" for="name">
                    Nama Partner <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name"
                       value="{{ old('name', $partner->name) }}"
                       placeholder="Contoh: Universitas AMIKOM Yogyakarta"
                       class="w-full border border-slate-200 rounded-2xl px-5 py-4 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Logo URL --}}
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2" for="logo_url">
                    URL Logo
                </label>
                <input type="url" id="logo_url" name="logo_url"
                       value="{{ old('logo_url', $partner->logo_url) }}"
                       placeholder="https://example.com/logo.png"
                       class="w-full border border-slate-200 rounded-2xl px-5 py-4 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition @error('logo_url') border-red-400 @enderror">
                @error('logo_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Website URL --}}
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2" for="website_url">
                    URL Website
                </label>
                <input type="url" id="website_url" name="website_url"
                       value="{{ old('website_url', $partner->website_url) }}"
                       placeholder="https://www.example.com"
                       class="w-full border border-slate-200 rounded-2xl px-5 py-4 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition @error('website_url') border-red-400 @enderror">
                @error('website_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-2" for="description">
                    Deskripsi
                </label>
                <textarea id="description" name="description" rows="4"
                          placeholder="Deskripsi singkat mengenai partner ini..."
                          class="w-full border border-slate-200 rounded-2xl px-5 py-4 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition @error('description') border-red-400 @enderror">{{ old('description', $partner->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 active:scale-95 transition shadow-lg shadow-indigo-100">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.partners.index') }}"
                   class="px-8 py-4 bg-slate-100 text-slate-700 font-bold rounded-2xl hover:bg-slate-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
