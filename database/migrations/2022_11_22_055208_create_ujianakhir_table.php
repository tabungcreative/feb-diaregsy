<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianakhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujianakhir', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama')->nullable();
            $table->string('prodi')->nullable();
            $table->string('email');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nik');
            $table->string('pembimbing1');
            $table->string('pembimbing2');
            $table->string('judul_skripsi');
            $table->string('berkas_skripsi')->nullable();
            $table->string('ijazah_terakhir')->nullable();
            $table->string('transkrip_nilai')->nullable();
            $table->string('akta_kelahiran')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('ktp')->nullable();
            $table->string('lembar_bimbingan')->nullable();
            $table->string('slip_pembayaransemesterterakhir')->nullable();
            $table->string('slip_pembayaranSkripsi')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('no_whatsapp');
            $table->string('no_pembayaran');
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
        Schema::dropIfExists('ujianakhir');
    }
}
