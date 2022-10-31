<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBimbinganskripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbinganskripsi', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama')->nullable();
            $table->string('prodi')->nullable();
            $table->string('email');
            $table->string('judul_skripsi');
            $table->string('pembimbing1');
            $table->string('pembimbing2');
            $table->string('no_whatsapp');
            $table->string('no_pembayaran');
            $table->unsignedBigInteger('sempro_id')->nullable();
            // $table->foreign('sempro_id')
            //     ->references('id')->on('sempro');
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
        Schema::dropIfExists('bimbinganskripsi');
    }
}
