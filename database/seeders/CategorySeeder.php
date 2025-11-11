<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Dimsum Ayam',
                'slug' => 'dimsum-ayam',
                'description' => 'Dimsum dengan isian daging ayam pilihan yang lezat dan bergizi',
                'is_active' => true,
            ],
            [
                'name' => 'Dimsum Udang',
                'slug' => 'dimsum-udang',
                'description' => 'Dimsum dengan isian udang segar berkualitas tinggi',
                'is_active' => true,
            ],
            [
                'name' => 'Dimsum Campur',
                'slug' => 'dimsum-campur',
                'description' => 'Dimsum dengan isian campuran ayam dan udang',
                'is_active' => true,
            ],
            [
                'name' => 'Dimsum Sayuran',
                'slug' => 'dimsum-sayuran',
                'description' => 'Dimsum vegetarian dengan isian sayuran segar',
                'is_active' => true,
            ],
            [
                'name' => 'Paket Hemat',
                'slug' => 'paket-hemat',
                'description' => 'Paket dimsum dengan harga spesial dan hemat',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
