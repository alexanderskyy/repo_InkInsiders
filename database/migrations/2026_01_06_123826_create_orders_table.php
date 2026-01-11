<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->text('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_zip', 10);
            $table->string('payment_method');
            $table->decimal('total', 15, 2);
            // ✅ PERBAIKAN: Tambah nilai 'pending_payment' dan 'paid'
            $table->enum('status', [
                'pending_payment',  // Status saat checkout selesai, menunggu pembayaran
                'paid',             // Status saat sudah dibayar
                'processing',       // Status saat admin memproses
                'shipped',          // Status saat dikirim
                'completed',        // Status saat selesai
                'cancelled'         // Status saat dibatalkan
            ])->default('pending_payment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};