<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;
use App\Models\User;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user as creator
        $admin = User::where('email', 'admin@dimsumlicious.com')->first();

        $promos = [
            [
                'title' => 'Diskon 20% Weekend Spesial',
                'description' => 'Dapatkan diskon 20% untuk semua jenis dimsum setiap akhir pekan! Promo berlaku untuk pembelian minimal 10 pcs.',
                'discount' => 20,
                'start_date' => Carbon::now()->startOfWeek(),
                'end_date' => Carbon::now()->endOfMonth(),
                'is_active' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Beli 2 Gratis 1 Paket Ramadhan',
                'description' => 'Spesial bulan Ramadhan! Beli 2 paket hemat gratis 1 paket reguler. Buruan pesan sebelum kehabisan!',
                'discount' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(2),
                'is_active' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Grand Opening Diskon 50%',
                'description' => 'Perayaan Grand Opening! Diskon hingga 50% untuk semua produk. Kesempatan terbatas!',
                'discount' => 50,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addDays(7),
                'is_active' => true,
                'created_by' => $admin->id,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::create($promo);
        }
    }
}
