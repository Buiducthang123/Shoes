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
        Schema::create('product_color_size_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_colors_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedFloat('cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_color_size_prices');
    }
};
