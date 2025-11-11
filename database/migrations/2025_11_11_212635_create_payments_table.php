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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Relasi ke orders
            
            $table->string('payment_method')->default('qris'); // Metode pembayaran (saat ini hanya QRIS)
            $table->decimal('amount', 12, 2); // Jumlah yang harus dibayar
            
            // Status pembayaran: pending, verified, rejected
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            
            // Bukti transfer
            $table->string('proof_image')->nullable(); // Path gambar bukti transfer
            $table->timestamp('uploaded_at')->nullable(); // Waktu upload bukti transfer
            
            // Verifikasi oleh admin/staff
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Admin/Staff yang verifikasi
            $table->timestamp('verified_at')->nullable(); // Waktu verifikasi
            $table->text('verification_notes')->nullable(); // Catatan verifikasi/penolakan
            
            // QRIS Info
            $table->string('qris_image')->nullable(); // Path ke gambar QR code QRIS
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
