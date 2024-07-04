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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('komen')->nullable();
            $table->string('employee_name');
            $table->string('loket');
            $table->string('shift');
            $table->string('nip');
            $table->string('sangat_puas');
            $table->string('puas');
            $table->string('sedang');
            $table->string('tidak_puas');
            $table->string('sangat_tidak_puas');
            $table->timestamp('_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
