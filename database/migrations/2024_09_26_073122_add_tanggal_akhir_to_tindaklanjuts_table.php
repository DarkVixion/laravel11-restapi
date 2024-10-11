<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalAkhirToTindaklanjutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tindak_lanjuts', function (Blueprint $table) {
            $table->date('tanggal_akhir')->nullable();  // Adding nullable since it might not be set initially
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tindak_lanjuts', function (Blueprint $table) {
            $table->dropColumn('tanggal_akhir');
        });
    }
}