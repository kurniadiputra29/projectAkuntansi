<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturPembelianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_pembelian_details', function (Blueprint $table) {
          $table->Increments('id');
          $table->unsignedInteger('retur_pembelian_id');
          $table->string('nomor_akun');
          $table->string('nama_akun');
          $table->integer('debet')->nullable();
          $table->integer('kredit')->nullable();
          $table->timestamps();

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
        Schema::dropIfExists('retur_pembelian_details');
    }
}
