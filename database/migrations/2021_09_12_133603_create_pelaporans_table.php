<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->id('id_pelaporan');
            $table->dateTime('tgl_pelaporan');
            $table->char('nik', 16);
            $table->string('nama_karyawan');
            $table->string('status_karyawan');
            $table->string('departemen');
            $table->string('kategori_bahaya');
            $table->text('isi_laporan');
            $table->dateTime('tgl_kejadian');
            $table->time('waktu_kejadian');
            $table->text('lokasi_kejadian');
            $table->string('foto');
            $table->enum('status', ['0', 'proses', 'selesai']);

            $table->timestamps();

            $table->foreign('nik')->references('nik')->on('karyawan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelaporan');
    }
}