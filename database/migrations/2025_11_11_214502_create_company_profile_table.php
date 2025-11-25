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
            $table->string('tagline')->nullable(); // Tagline perusahaan
            $table->text('about_us')->nullable(); // Deskripsi singkat tentang Dimsumlicious
            $table->text('address'); // Alamat toko/lokasi
            $table->string('phone'); // Nomor telepon
            $table->string('whatsapp')->nullable(); // Nomor WhatsApp
            $table->string('email')->nullable(); // Email
            $table->string('logo')->nullable(); // Logo perusahaan
            $table->string('hero_image')->nullable(); // Gambar hero di homepage
            $table->string('operating_hours_weekdays')->nullable(); // Jam operasional weekdays
            $table->string('operating_hours_weekend')->nullable(); // Jam operasional weekend
            $table->string('instagram')->nullable(); // Instagram handle
            $table->string('facebook')->nullable(); // Facebook page
            $table->string('tiktok')->nullable(); // TikTok handle
            $table->integer('founded_year')->nullable(); // Tahun berdiri
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null'); // Admin yang terakhir edit
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
