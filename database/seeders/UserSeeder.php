<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $adminRole = Role::where('name', 'admin')->first();
        $staffRole = Role::where('name', 'staff')->first();
        $userRole = Role::where('name', 'user')->first();

        // Demo Admin Account
        User::updateOrCreate(
            ['email' => 'admin@dimsumlicious.com'],
            [
                'name' => 'Admin Dimsum',
                'email' => 'admin@dimsumlicious.com',
                'password' => Hash::make('12345678'),
                'role_id' => $adminRole->id,
                'phone' => '081234567890',
                'address' => 'Jl. Dimsum No. 123, Jakarta Pusat',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // Demo Staff Account
        User::updateOrCreate(
            ['email' => 'staff@dimsumlicious.com'],
            [
                'name' => 'Staff Dimsum',
                'email' => 'staff@dimsumlicious.com',
                'password' => Hash::make('12345678'),
                'role_id' => $staffRole->id,
                'phone' => '081234567891',
                'address' => 'Jl. Dimsum No. 124, Jakarta Pusat',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // Demo User Account
        User::updateOrCreate(
            ['email' => 'user@dimsumlicious.com'],
            [
                'name' => 'User Dimsum',
                'email' => 'user@dimsumlicious.com',
                'password' => Hash::make('12345678'),
                'role_id' => $userRole->id,
                'phone' => '081234567892',
                'address' => 'Jl. Dimsum No. 125, Jakarta Pusat',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        echo "\n✅ Demo accounts created successfully!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📧 Admin:\n";
        echo "   Email: admin@dimsumlicious.com\n";
        echo "   Password: 12345678\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📧 Staff:\n";
        echo "   Email: staff@dimsumlicious.com\n";
        echo "   Password: 12345678\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📧 User:\n";
        echo "   Email: user@dimsumlicious.com\n";
        echo "   Password: 12345678\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    }
}
