<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $ayam = Category::where('slug', 'dimsum-ayam')->first();
        $udang = Category::where('slug', 'dimsum-udang')->first();
        $campur = Category::where('slug', 'dimsum-campur')->first();
        $sayur = Category::where('slug', 'dimsum-sayuran')->first();
        $paket = Category::where('slug', 'paket-hemat')->first();

        $products = [
            // Dimsum Ayam
            [
                'category_id' => $ayam->id,
                'name' => 'Dimsum Ayam Original',
                'slug' => 'dimsum-ayam-original',
                'description' => 'Dimsum ayam dengan resep original yang lembut dan gurih',
                'price' => 25000,
                'stock' => 100,
                'is_available' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $ayam->id,
                'name' => 'Dimsum Ayam Keju',
                'slug' => 'dimsum-ayam-keju',
                'description' => 'Dimsum ayam dengan tambahan keju mozarella yang melimpah',
                'price' => 28000,
                'stock' => 80,
                'is_available' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => $ayam->id,
                'name' => 'Dimsum Ayam Pedas',
                'slug' => 'dimsum-ayam-pedas',
                'description' => 'Dimsum ayam dengan bumbu pedas yang menggugah selera',
                'price' => 27000,
                'stock' => 75,
                'is_available' => true,
                'is_featured' => false,
            ],

            // Dimsum Udang
            [
                'category_id' => $udang->id,
                'name' => 'Dimsum Udang Original',
                'slug' => 'dimsum-udang-original',
                'description' => 'Dimsum udang segar dengan tekstur kenyal dan rasa laut yang khas',
                'price' => 30000,
                'stock' => 90,
                'is_available' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $udang->id,
                'name' => 'Dimsum Udang Keju',
                'slug' => 'dimsum-udang-keju',
                'description' => 'Perpaduan udang segar dan keju mozarella yang sempurna',
                'price' => 33000,
                'stock' => 70,
                'is_available' => true,
                'is_featured' => false,
            ],

            // Dimsum Campur
            [
                'category_id' => $campur->id,
                'name' => 'Dimsum Campur Spesial',
                'slug' => 'dimsum-campur-spesial',
                'description' => 'Kombinasi ayam dan udang dalam satu gigitan yang sempurna',
                'price' => 32000,
                'stock' => 85,
                'is_available' => true,
                'is_featured' => true,
            ],

            // Dimsum Sayuran
            [
                'category_id' => $sayur->id,
                'name' => 'Dimsum Sayur Original',
                'slug' => 'dimsum-sayur-original',
                'description' => 'Dimsum vegetarian dengan sayuran segar pilihan',
                'price' => 22000,
                'stock' => 60,
                'is_available' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => $sayur->id,
                'name' => 'Dimsum Sayur Jamur',
                'slug' => 'dimsum-sayur-jamur',
                'description' => 'Dimsum vegetarian dengan jamur shitake dan sayuran',
                'price' => 24000,
                'stock' => 55,
                'is_available' => true,
                'is_featured' => false,
            ],

            // Paket Hemat
            [
                'category_id' => $paket->id,
                'name' => 'Paket Hemat 10 Pcs',
                'slug' => 'paket-hemat-10-pcs',
                'description' => 'Paket isi 10 dimsum campur dengan harga hemat',
                'price' => 45000,
                'stock' => 50,
                'is_available' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => $paket->id,
                'name' => 'Paket Hemat 20 Pcs',
                'slug' => 'paket-hemat-20-pcs',
                'description' => 'Paket isi 20 dimsum campur dengan harga sangat hemat',
                'price' => 85000,
                'stock' => 40,
                'is_available' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $paket->id,
                'name' => 'Paket Keluarga 50 Pcs',
                'slug' => 'paket-keluarga-50-pcs',
                'description' => 'Paket besar isi 50 dimsum untuk acara keluarga',
                'price' => 200000,
                'stock' => 20,
                'is_available' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
