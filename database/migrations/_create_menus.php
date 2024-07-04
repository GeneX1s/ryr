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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('harga')->nullable();
            $table->string('nilai')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('foto');
            $table->string('kategori_1');
            $table->string('kategori_2');
            $table->timestamp('_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
