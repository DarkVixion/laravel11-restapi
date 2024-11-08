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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('img', 255)->nullable();
            $table->foreignId('user_id')->constrained('users'); // Assuming you are using the default users table
            $table->foreignId('lokasi_id')->constrained('lokasis');
            $table->foreignId('tipe_observasi_id')->constrained('tipe_observasis');
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->foreignId('clsr_id')->constrained('clsrs');
            $table->string('nama_pegawai');
            $table->string('email_pegawai');
            $table->string('nama_fungsi');
            $table->string('lokasi_spesifik');
            $table->string('deskripsi_observasi');
            $table->string('direct_action');
            $table->string('non_clsr'); // Add your column here
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};