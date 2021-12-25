<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->foreignId('id')->primary();
            $table->enum('status_peminjaman', ['waitlist', 'acc', 'reject', 'pinjam', 'kembali']);
            $table->dateTime('tanggal_pinjam')->nullable();
            $table->dateTime('tanggal_kembali')->nullable();
            $table->foreignId('pegawai_id');
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
        Schema::dropIfExists('peminjamen');
    }
}
