<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBengkelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bengkels', function (Blueprint $table) {
            $table->bigIncrements('id_bengkel');
            $table->string('nama_bengkel');
            $table->string('jenis_bengkel');
            $table->string('alamat_bengkel');
            $table->string('nomor_telepon');
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
        Schema::dropIfExists('bengkels');
    }
}
