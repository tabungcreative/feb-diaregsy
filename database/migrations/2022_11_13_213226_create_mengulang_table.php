<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMengulangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mengulang', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama')->nullable();
            $table->string('prodi')->nullable();
            $table->string('email');
            $table->string('no_whatsapp');
            // $table->string('no_pembayaran');
            $table->string('khs')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->foreign('tahun_ajaran_id')
                ->references('id')->on('tahun_ajaran');
            $table->boolean('is_verify')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mengulang');
    }
}
