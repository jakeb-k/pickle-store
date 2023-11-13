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
            $table->string('name')->unique();
            $table->string('url');
            $table->string('type'); 
            $table->float('price');
            $table->float('discount')->nullable();
            $table->string('sku')->unique();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('tags')->nullable(); 
            $table->float('rating')->nullable(); 
            $table->boolean('available'); 
            $table->string('options')->nullable(); 
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
