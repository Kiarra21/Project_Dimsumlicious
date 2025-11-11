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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul promosi (contoh: "Diskon 20% Akhir Pekan")
            $table->text('description'); // Deskripsi promosi
            $table->string('banner_image')->nullable(); // Path gambar banner promosi
            $table->date('start_date'); // Tanggal mulai promo
            $table->date('end_date'); // Tanggal akhir promo
            $table->boolean('is_active')->default(true); // Status aktif/tidak aktif
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Admin/Staff yang buat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
