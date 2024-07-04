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
        Schema::create('inventory_detail', function (Blueprint $table) {
            $table->id();
            $table->string('id_grup');//id dari inventory
            $table->string('kode');
            $table->string('nilai')->nullable();
            $table->string('satuan')->nullable();//gram,centi,sdm,dll
            $table->string('notes')->nullable();//barang rusak,hilang,basi,dll
            $table->timestamp('_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
