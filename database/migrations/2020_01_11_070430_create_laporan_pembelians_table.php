<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pembelians', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('cpj_id')->nullable();
            $table->unsignedInteger('purchasejournal_id')->nullable();
            $table->unsignedInteger('retur_pembelian_id')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();

            $table->foreign('cpj_id')->references('id')->on('cpjs')->onDelete('cascade');
            $table->foreign('purchasejournal_id')->references('id')->on('purchase_journals')->onDelete('cascade');
            $table->foreign('retur_pembelian_id')->references('id')->on('retur_pembelians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_pembelians');
    }
}
