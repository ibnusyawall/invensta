<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelasiInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->foreign('ruang_id')
                ->references('id')
                ->on('ruangs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('jenis_id')
                ->references('id')
                ->on('jenis')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('petugas_id')
                ->references('id')
                ->on('petugas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            //
        });
    }
}
