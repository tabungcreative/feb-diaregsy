<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUjianakhirChangeJudulSkripsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujianakhir', function (Blueprint $table) {
            $table->text('judul_skripsi')->change();
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
            $table->string('judul_skripsi')->change();
        });
    }
}
