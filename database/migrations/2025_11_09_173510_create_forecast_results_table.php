<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('forecast_results', function (Blueprint $table) {
            $table->id('forecast_id');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->date('forecast_date');
            $table->integer('predicted_demand');
            $table->string('model_used', 100)->nullable(); // misal "ARIMA", "LSTM", dll
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forecast_results');
    }
};
