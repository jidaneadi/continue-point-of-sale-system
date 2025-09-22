<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('province', function (Blueprint $table) {
            $table->string('id_prov', 12)->primary();
            $table->string('nama_prov');
        });
        Schema::create('city', function (Blueprint $table) {
            $table->string('id_city', 12)->primary();
            $table->string('id_prov')->index();
            $table->string('nama_city');
        });
        Schema::create('subdistrict', function (Blueprint $table) {
            $table->string('id_sub', 12)->primary();
            $table->string('id_city')->index();
            $table->string('nama_sub');
        });
        Schema::create('village', function (Blueprint $table) {
            $table->string('id_vil', 12)->primary();
            $table->string('id_sub')->index();
            $table->string('nama_vil');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('province');
        Schema::dropIfExists('city');
        Schema::dropIfExists('subdistrict');
        Schema::dropIfExists('village');
    }
};
