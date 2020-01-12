<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_penjualans', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('crj_id')->nullable();
            $table->unsignedInteger('salesjournal_id')->nullable();
            $table->unsignedInteger('retur_penjualan_id')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();

            $table->foreign('crj_id')->references('id')->on('crjs')->onDelete('cascade');
            $table->foreign('salesjournal_id')->references('id')->on('sales_journals')->onDelete('cascade');
            $table->foreign('retur_penjualan_id')->references('id')->on('retur_penjualans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_penjualans');
    }
}
