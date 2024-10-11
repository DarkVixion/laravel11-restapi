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
        Schema::create('clsrs', function (Blueprint $table) {
            $table->id();
            $table->string('elemen', 255);
            $table->string('nama', 255);
            $table->string('deskripsi')->nullable();
            $table->string('contoh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clsrs');
    }
};