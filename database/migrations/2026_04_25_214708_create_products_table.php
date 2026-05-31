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
    $table->string('title'); // Ürün/Kurs adı [cite: 37]
    $table->text('description')->nullable(); // Detaylı açıklama 
    $table->decimal('price', 10, 2); // Ürün fiyatı [cite: 37]
    $table->integer('stock')->default(0); // Stok adeti [cite: 37]
    $table->string('image_path')->nullable(); // Ürün fotoğrafı [cite: 39]
    $table->boolean('is_active')->default(true); // Satışta mı/Kaldırıldı mı? [cite: 38]
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
