<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYudisiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yudisium', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama')->nullable();
            $table->string('prodi')->nullable();
            $table->string('judul_skripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_ujian');
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('pembimbing1');
            $table->string('pembimbing2');
            $table->string('no_whatsapp');
            $table->string('ukuran_toga');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('bebas_spp')->nullable();
            $table->string('transkrip_nilai')->nullable();
            $table->string('bebas_perpus')->nullable();
            $table->string('artikel')->nullable();
            $table->string('file_skripsi')->nullable();
            $table->string('bebas_plagiasi')->nullable();
            $table->string('bukti_penjilidan')->nullable();
            $table->string('bukti_pengumpulan')->nullable();
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
        Schema::dropIfExists('yudisium');
    }
}
