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
        Schema::create('company_profile', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Dimsumlicious'); // Nama perusahaan
            $table->text('about_us'); // Deskripsi singkat tentang Dimsumlicious
            $table->text('address'); // Alamat toko/lokasi
            $table->string('phone'); // Nomor telepon
            $table->string('whatsapp'); // Nomor WhatsApp
            $table->string('email')->nullable(); // Email
            $table->string('logo')->nullable(); // Logo perusahaan
            $table->string('hero_image')->nullable(); // Gambar hero di homepage
            $table->text('social_media')->nullable(); // JSON untuk social media links (Instagram, Facebook, dll)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profile');
    }
};
