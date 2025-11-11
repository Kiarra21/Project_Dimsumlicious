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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Relasi ke categories
            $table->string('name'); // Nama produk (contoh: Dimsum Ayam Original)
            $table->string('slug')->unique(); // URL-friendly name
            $table->text('description')->nullable(); // Deskripsi produk
            $table->decimal('price', 10, 2); // Harga produk (contoh: 25000.00)
            $table->integer('stock')->default(0); // Stok produk
            $table->string('image')->nullable(); // Gambar produk
            $table->boolean('is_available')->default(true); // Status ketersediaan
            $table->boolean('is_featured')->default(false); // Produk unggulan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
