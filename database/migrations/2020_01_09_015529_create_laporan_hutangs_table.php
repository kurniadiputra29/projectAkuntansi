<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanHutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_hutangs', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('suppliers_id')->nullable();
            $table->unsignedInteger('saldo_hutangs_id')->nullable();
            $table->unsignedInteger('purchasejournal_id')->nullable();
            $table->unsignedInteger('retur_pembelian_id')->nullable();
            $table->unsignedInteger('cash_bank_outs_id')->nullable();
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();

            $table->foreign('suppliers_id')->references('id')->on('data_suppliers')->onDelete('cascade');
            $table->foreign('saldo_hutangs_id')->references('id')->on('saldo_hutangs')->onDelete('cascade');
            $table->foreign('purchasejournal_id')->references('id')->on('purchase_journals')->onDelete('cascade');
            $table->foreign('retur_pembelian_id')->references('id')->on('retur_pembelians')->onDelete('cascade');
            $table->foreign('cash_bank_outs_id')->references('id')->on('cash_bank_outs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_hutangs');
    }
}
