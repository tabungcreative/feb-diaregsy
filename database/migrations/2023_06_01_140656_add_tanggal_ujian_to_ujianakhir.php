<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalUjianToUjianakhir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujianakhir', function (Blueprint $table) {
            $table->date('tanggal_ujian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ujianakhir', function (Blueprint $table) {
            $table->dropColumn('tanggal_ujian');
        });
    }
}
