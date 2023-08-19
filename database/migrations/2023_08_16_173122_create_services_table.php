<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('services', function (Blueprint $table) {
        $table->bigIncrements('id_service');
        $table->string('no_polisi');
        $table->string('id_kontraksewa')->nullable();
        $table->unsignedBigInteger('id_bengkel'); // Gunakan unsignedBigInteger untuk foreign key
        $table->foreign('id_bengkel')->references('id_bengkel')->on('bengkels')->onDelete('cascade');
        $table->string('km');
        $table->string('km_selanjutnya');
        $table->string('jenis_service');
        $table->date('tanggal_penerima_service'); // Gunakan tipe data date untuk tanggal
        $table->date('tanggal_penyerahan_service'); // Gunakan tipe data date untuk tanggal
        $table->json('sparepart'); // Gunakan tipe data json untuk array
        $table->json('harga'); // Gunakan tipe data json untuk array
        $table->json('qty'); // Gunakan tipe data json untuk array
        $table->json('keterangan_sparepart'); // Gunakan tipe data json untuk array
        $table->string('harga_jasa');
        $table->string('total_harga_service');
        $table->string('approval');
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
        Schema::dropIfExists('services');
    }
}
