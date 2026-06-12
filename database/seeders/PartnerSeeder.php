<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Mengisi data awal partner/sponsor AmikomEventHub.
     */
    public function run(): void
    {
        $partners = [
            [
                'name'        => 'Universitas AMIKOM Yogyakarta',
                'logo_url'    => 'https://ui-avatars.com/api/?name=AMIKOM&background=4f46e5&color=fff&size=128',
                'website_url' => 'https://amikom.ac.id',
                'description' => 'Kampus digital terdepan di Yogyakarta, mendukung inovasi teknologi dan bisnis digital.',
            ],
            [
                'name'        => 'Bank BRI',
                'logo_url'    => 'https://ui-avatars.com/api/?name=BRI&background=003366&color=fff&size=128',
                'website_url' => 'https://bri.co.id',
                'description' => 'Bank Rakyat Indonesia, mendukung layanan pembayaran tiket event.',
            ],
            [
                'name'        => 'Midtrans Payment Gateway',
                'logo_url'    => 'https://ui-avatars.com/api/?name=Midtrans&background=00ae9d&color=fff&size=128',
                'website_url' => 'https://midtrans.com',
                'description' => 'Platform pembayaran digital terpercaya untuk transaksi event online.',
            ],
        ];

        foreach ($partners as $partner) {
            \App\Models\Partner::firstOrCreate(
                ['name' => $partner['name']],
                $partner
            );
        }
    }
}
