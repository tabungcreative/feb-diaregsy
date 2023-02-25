<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSplTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spl', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama')->nullable();
            $table->string('prodi')->nullable();
            // $table->string('no_pembayaran');
            // $table->string('foto_ktp')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->foreign('tahun_ajaran_id')
                ->references('id')->on('tahun_ajaran');
            $table->enum('jenis_pendaftaran', ['kip', 'reguler']);
            $table->string('no_whatsapp');
            $table->boolean('is_verify')->default(0);
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('spl');
    }
}
