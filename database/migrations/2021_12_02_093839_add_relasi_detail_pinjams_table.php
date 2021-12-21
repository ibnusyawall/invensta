<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelasiDetailPinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_pinjams', function (Blueprint $table) {
            $table->foreign('peminjaman_id')
                ->references('id')
                ->on('peminjamen')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('inventaris_id')
                ->references('id')
                ->on('inventaris')
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
        Schema::table('detail_pinjams', function (Blueprint $table) {
            //
        });
    }
}
