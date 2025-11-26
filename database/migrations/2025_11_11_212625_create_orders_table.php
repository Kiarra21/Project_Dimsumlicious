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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Nomor pesanan unik (contoh: ORD-20250112-0001)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke users (pembeli)
            
            // Status pesanan: pending_payment, pending_cooking, completed, rejected
            $table->enum('status', ['pending_payment', 'pending_cooking', 'completed', 'rejected'])
                  ->default('pending_payment');
            
            $table->decimal('subtotal', 12, 2); // Total harga item (sebelum ongkir, pajak, dll)
            $table->decimal('total', 12, 2); // Total keseluruhan
            
            // Informasi pengiriman/catatan
            $table->text('customer_notes')->nullable(); // Catatan dari customer
            $table->string('phone_number'); // Nomor HP untuk konfirmasi
            
            // Rejection info (jika ditolak)
            $table->text('rejection_reason')->nullable(); // Alasan penolakan
            $table->timestamp('rejected_at')->nullable(); // Waktu ditolak
            
            // Completion info
            $table->timestamp('completed_at')->nullable(); // Waktu selesai
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
