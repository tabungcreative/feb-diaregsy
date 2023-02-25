<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemproTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sempro', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama')->nullable();
            $table->string('prodi')->nullable();
            $table->string('email');
            $table->string('judul_sempro');
            $table->string('no_whatsapp');
            // $table->string('no_pembayaran');
            $table->string('nota_kaprodi')->nullable();
            $table->string('berkas_sempro')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('sempro');
    }
}
