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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->onDelete('cascade');
            $table->enum('user_type', ['Reg', 'Not-Reg']);
            $table->foreignId('product_id')->references('id')->onDelete('cascade');
            $table->foreignId('product_attr_id')->references('id')->onDelete('cascade');
            $table->string('qty');
            $table->dateTime('added_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
