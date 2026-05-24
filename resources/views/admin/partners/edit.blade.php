@extends('layouts.admin')

@section('title', 'Edit Partner - Admin')
@section('page_title', 'Edit Partner')
@section('page_subtitle', 'Ubah data partner yang sudah ada.')

@section('content')

<div class="max-w-xl">
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10">
        <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Partner --}}
            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                    Nama Partner <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $partner->name) }}"
                       placeholder="Nama partner..."
                       class="w-full px-5 py-3 rounded-xl border @error('name') border-rose-400 bg-rose-50 @else border-slate-200 @enderror focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                @error('name')
                    <p class="mt-2 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Logo URL --}}
            <div class="mb-6">
                <label for="logo_url" class="block text-sm font-bold text-slate-700 mb-2">
                    URL Logo <span class="text-slate-400 font-normal">(opsional)</span>
                </label>
                <input type="url"
                       id="logo_url"
                       name="logo_url"
                       value="{{ old('logo_url', $partner->logo_url) }}"
                       placeholder="https://example.com/logo.png"
                       class="w-full px-5 py-3 rounded-xl border @error('logo_url') border-rose-400 bg-rose-50 @else border-slate-200 @enderror focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm">
                @error('logo_url')
                    <p class="mt-2 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Preview Logo --}}
            @if($partner->logo_url)
            <div class="mb-6 p-4 bg-slate-50 rounded-xl border border-slate-100">
                <p class="text-xs font-bold text-slate-500 mb-3">Preview Logo Saat Ini:</p>
                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                     class="h-16 object-contain"
                     onerror="this.parentElement.innerHTML='<p class=\'text-xs text-rose-400\'>URL logo tidak valid.</p>'">
            </div>
            @endif

            {{-- Info --}}
            <div class="mb-6 p-4 bg-slate-50 rounded-xl text-xs text-slate-500 space-y-1 border border-slate-100">
                <p><span class="font-bold">ID:</span> {{ $partner->id }}</p>
                <p><span class="font-bold">Dibuat:</span> {{ $partner->created_at->format('d M Y, H:i') }}</p>
                <p><span class="font-bold">Diperbarui:</span> {{ $partner->updated_at->format('d M Y, H:i') }}</p>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 active:scale-95 transition">
                    Perbarui Partner
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
