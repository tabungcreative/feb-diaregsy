<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJadwalSeminarToSemproTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sempro', function (Blueprint $table) {
            $table->date('tanggal_seminar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sempro', function (Blueprint $table) {
            $table->dropColumn('tanggal_seminar');
        });
    }
}
