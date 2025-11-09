<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchaser_order_items', function (Blueprint $table) {
            $table->id('item_id');
            $table->foreignId('order_id')->constrained('purchaser_orders', 'order_id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
            $table->decimal('subtotal', 15, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchaser_order_items');
    }
};
