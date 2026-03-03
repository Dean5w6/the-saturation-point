<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('brand');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('img_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); 
            $table->string('img_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_tables');
    }
};
