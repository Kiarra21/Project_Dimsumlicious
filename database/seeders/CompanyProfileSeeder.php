<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProfile::create([
            'company_name' => 'Dimsumlicious',
            'tagline' => 'Cita Rasa Autentik di Setiap Gigitan',
            'about_us' => 'Dimsumlicious adalah penyedia dimsum berkualitas yang telah melayani ribuan pelanggan sejak tahun 2020. Kami berkomitmen untuk menyajikan dimsum dengan bahan-bahan pilihan dan cita rasa yang otentik. Setiap dimsum dibuat segar setiap hari dengan resep spesial kami.',
            'address' => 'Jl. Raya Dimsum No. 123, Jakarta Selatan, DKI Jakarta 12345',
            'phone' => '021-12345678',
            'whatsapp' => '081234567890',
            'email' => 'info@dimsumlicious.com',
            'operating_hours_weekdays' => '08:00 - 22:00',
            'operating_hours_weekend' => '09:00 - 23:00',
            'instagram' => 'https://instagram.com/dimsumlicious',
            'facebook' => 'https://facebook.com/dimsumlicious',
            'tiktok' => 'https://tiktok.com/@dimsumlicious',
            'founded_year' => 2020,
        ]);
    }
}
