<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturPenjualanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_penjualan_details', function (Blueprint $table) {
          $table->Increments('id');
          $table->unsignedInteger('retur_penjualan_id');
          $table->string('nomor_akun');
          $table->string('nama_akun');
          $table->integer('debet')->nullable();
          $table->integer('kredit')->nullable();
          $table->timestamps();

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
        Schema::dropIfExists('retur_penjualan_details');
    }
}
