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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('products_id');
            $table->uuid('customers_id');
            $table->integer('jumlah');
            $table->uuid('photo_session_id');
            $table->date('schedule')->nullable();
            $table->timestamps();

            $table->index('products_id')->references('id')->on('products')->onDelete("cascade");
            $table->index('customers_id')->references('id')->on('customers')->onDelete("cascade");
            $table->index('photo_session_id')->references('id')->on('photo_sessions')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
