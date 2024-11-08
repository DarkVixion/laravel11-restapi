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
        Schema::create('tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('tipe', 50);
            $table->string('status', 50);
            $table->text('deskripsi');
            $table->string('img', 255)->nullable();
            $table->foreignId('laporan_id')->constrained('laporans');
            $table->date('tanggal_akhir')->nullable();
            $table->foreignId('lokasi_id')->constrained('lokasis');
            $table->foreignId('tipe_observasi_id')->constrained('tipe_observasis');
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->foreignId('clsr_id')->constrained('clsrs');
            $table->string('detail_lokasi');
            $table->string('direct_action');
            $table->string('non_clsr');
            $table->string('follow_up');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjuts');
    }
};