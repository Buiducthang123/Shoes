<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->integer('quantity'); //số lượng
            $table->text('description'); //mô tả
            $table->string('image'); //hình ảnh
            $table->float('base_price');//giá cơ bản
            $table->boolean('disabled'); // sản phẩm còn đc bán không
            $table->unsignedBigInteger('sales_quantity');//so luong ban
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