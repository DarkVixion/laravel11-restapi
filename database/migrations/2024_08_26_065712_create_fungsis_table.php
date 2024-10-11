<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFungsisTable extends Migration
{
    public function up()
    {
        Schema::create('fungsis', function (Blueprint $table) {
            $table->id();
            $table->string('departemen', 100);
            $table->string('jabatan', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fungsis');
    }
}