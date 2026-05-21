@extends('layouts.admin')

@section('title', 'Edit Partner - Admin')
@section('page_title', 'Edit Partner')
@section('page_subtitle', 'Ubah data partner yang sudah ada.')

@section('content')

<div class="max-w-xl">
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10">
        <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
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

            {{-- Preview Logo Saat Ini --}}
            @if($partner->logo_url)
            <div class="mb-4 p-4 bg-slate-50 rounded-xl border border-slate-100">
                <p class="text-xs font-bold text-slate-500 mb-3">Logo Saat Ini:</p>
                <img src="{{ asset('storage/' . $partner->logo_url) }}"
                     alt="{{ $partner->name }}"
                     class="h-16 object-contain rounded-lg"
                     onerror="this.parentElement.innerHTML='<p class=\'text-xs text-rose-400\'>Logo tidak dapat dimuat.</p>'">
            </div>
            @endif

            {{-- Upload Logo Baru --}}
            <div class="mb-8">
                <label for="logo" class="block text-sm font-bold text-slate-700 mb-2">
                    {{ $partner->logo_url ? 'Ganti Logo' : 'Upload Logo' }}
                    <span class="text-slate-400 font-normal">(opsional, maks. 2MB)</span>
                </label>
                <input type="file"
                       id="logo"
                       name="logo"
                       accept="image/*"
                       class="w-full px-4 py-3 rounded-xl border @error('logo') border-rose-400 bg-rose-50 @else border-slate-200 bg-slate-50 @enderror text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 file:font-bold hover:file:bg-indigo-100 transition">
                @error('logo')
                    <p class="mt-2 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
                @if($partner->logo_url)
                    <p class="mt-2 text-xs text-slate-400">Biarkan kosong jika tidak ingin mengganti logo.</p>
                @endif
            </div>

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
