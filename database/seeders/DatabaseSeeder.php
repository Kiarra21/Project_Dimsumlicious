<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in order
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            PromoSeeder::class,
            CompanyProfileSeeder::class,
        ]);

        echo "\n🎉 Database seeding completed successfully!\n";
        echo "📦 Categories: 5 items\n";
        echo "🥟 Products: 11 items\n";
        echo "🎁 Promos: 3 items\n";
        echo "🏢 Company Profile: 1 item\n";
        echo "👥 Users: 3 accounts (admin, staff, user)\n\n";
    }
}
