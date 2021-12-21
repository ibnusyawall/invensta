<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->foreignId('id')->primary();
            $table->string('nama');
            $table->string('kondisi');
            $table->text('keterangan');
            $table->integer('jumlah');
            $table->dateTime('tanggal_register');
            $table->string('kode_inventaris');
            $table->foreignId('jenis_id');
            $table->foreignId('ruang_id');
            $table->foreignId('petugas_id');
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
        Schema::dropIfExists('inventaris');
    }
}
