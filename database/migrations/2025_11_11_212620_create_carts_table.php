<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke users
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Relasi ke products
            $table->integer('quantity')->default(1); // Jumlah item
            $table->decimal('price', 10, 2); // Harga saat item ditambahkan ke keranjang
            $table->timestamps();
            
            // Unique constraint: satu user tidak bisa punya produk yang sama lebih dari sekali di keranjang
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
