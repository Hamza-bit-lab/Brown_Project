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
            $table->foreignId('category_id')->references('id')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('model');
            $table->longText('short_desc');
            $table->longText('description');
            $table->longText('keywords');
            $table->longText('technical_specs');
            $table->longText('uses');
            $table->longText('warranty');
            $table->integer('status');
            $table->enum('is_promo', ['yes', 'no']);
            $table->enum('is_featured', ['yes', 'no']);
            $table->enum('is_trending', ['yes', 'no']);
            $table->enum('is_discounted', ['yes', 'no']);
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
