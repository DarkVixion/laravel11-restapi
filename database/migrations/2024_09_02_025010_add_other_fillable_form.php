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
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('nama_pegawai');
            $table->string('email_pegawai');
            $table->string('nama_fungsi');
            $table->string('lokasi_spesifik');
            $table->string('deskripsi_observasi');
            $table->string('direct_action');
            $table->string('saran_aplikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['nama_pegawai', 'email_pegawai','nama_fungsi','lokasi_spesifik','deskripsi_observasi','direct_action','saran_aplikasi']);
        });
    }
};