<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Pertemuan 9 - Validation & File Upload
 * Form Request class khusus untuk validasi data checkout.
 * Memisahkan logika validasi dari Controller agar lebih bersih.
 */
class CheckoutRequest extends FormRequest
{
    /**
     * Tentukan apakah user berhak membuat request ini.
     * Karena checkout terbuka untuk umum (guest checkout), return true.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan-aturan validasi yang berlaku untuk input checkout.
     */
    public function rules(): array
    {
        return [
            'customer_name'  => 'required|string|min:3|max:100',
            'customer_email' => 'required|email|max:150',
            'customer_phone' => 'required|string|min:9|max:15|regex:/^[0-9]+$/',
            'quantity'       => 'required|integer|min:1|max:10',
        ];
    }

    /**
     * Pesan error kustom dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'customer_name.required'  => 'Nama lengkap wajib diisi.',
            'customer_name.min'       => 'Nama minimal 3 karakter.',
            'customer_email.required' => 'Alamat email wajib diisi.',
            'customer_email.email'    => 'Format email tidak valid.',
            'customer_phone.required' => 'Nomor WhatsApp wajib diisi.',
            'customer_phone.regex'    => 'Nomor WhatsApp hanya boleh berisi angka.',
            'customer_phone.min'      => 'Nomor WhatsApp minimal 9 digit.',
            'quantity.required'       => 'Jumlah tiket wajib dipilih.',
            'quantity.min'            => 'Minimal pemesanan 1 tiket.',
            'quantity.max'            => 'Maksimal pemesanan 10 tiket sekaligus.',
        ];
    }

    /**
     * Label nama field yang tampil di pesan error.
     */
    public function attributes(): array
    {
        return [
            'customer_name'  => 'Nama Lengkap',
            'customer_email' => 'Email',
            'customer_phone' => 'Nomor WhatsApp',
            'quantity'       => 'Jumlah Tiket',
        ];
    }
}
