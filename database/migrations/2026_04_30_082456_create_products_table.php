<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name'); // Brand name field
            $table->string('name'); // Product name
            $table->string('category'); // Category dropdown
            $table->json('sizes'); // Sizes (checkbox) - stored as JSON array
            $table->string('color'); // Color dropdown
            $table->text('description'); // Description textbox
            $table->decimal('price', 10, 2); // Price
            $table->json('images'); // Multiple images (file) - stored as JSON array
            $table->timestamps(); // Indexes for better performance
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};