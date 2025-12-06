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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('strawberry_product_id')->constrained()->onDelete('cascade');
            $table->string('product_name'); // Nama produk (disimpan untuk history)
            $table->integer('quantity');
            $table->decimal('price_per_unit', 10, 2); // Harga per produk
            $table->decimal('subtotal', 12, 2); // Total untuk item ini (quantity * price_per_unit)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
