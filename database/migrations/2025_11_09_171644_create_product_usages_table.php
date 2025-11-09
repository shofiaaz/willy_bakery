<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_usages', function (Blueprint $table) {
            $table->id('usage_id');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('raw_materials', 'material_id')->onDelete('cascade');
            $table->integer('quantity_used');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_usages');
    }
};
