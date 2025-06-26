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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('transaction_id');
            $table->uuid('product_id');
            $table->uuid('photo_session_id');
            $table->uuid('discount_id')->nullable();
            $table->uuid('photographer_id')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->text('link')->nullable();
            $table->boolean('status');
            $table->timestamps();

            $table->index('transaction_id')->references('id')->on('transactions')->onDelete("cascade");
            $table->index('product_id')->references('id')->on('products')->onDelete("cascade");
            $table->index('photo_session_id')->references('id')->on('photo_sessions')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
