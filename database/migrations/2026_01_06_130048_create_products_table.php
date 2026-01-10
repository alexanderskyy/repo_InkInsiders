<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY auto_increment
            $table->string('kode_produk', 50)->unique(); // kode bisnis
            $table->string('nama_produk');
            $table->string('kategori');
            $table->integer('stok')->default(0);
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};