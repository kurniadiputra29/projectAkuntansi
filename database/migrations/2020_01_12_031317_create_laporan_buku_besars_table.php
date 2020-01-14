<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanBukuBesarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_buku_besars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('account_id')->nullable();
            $table->string('nomor_akun')->nullable();
            $table->unsignedInteger('saldo_awals_id')->nullable();
            $table->unsignedInteger('crj_id')->nullable();
            $table->unsignedInteger('cpj_id')->nullable();
            $table->unsignedInteger('purchasejournal_id')->nullable();
            $table->unsignedInteger('salesjournal_id')->nullable();
            $table->unsignedInteger('retur_penjualan_id')->nullable();
            $table->unsignedInteger('retur_pembelian_id')->nullable();
            $table->unsignedInteger('cash_bank_ins_id')->nullable();
            $table->unsignedInteger('cash_bank_outs_id')->nullable();
            $table->unsignedInteger('jurnal_umums_id')->nullable();
            $table->unsignedInteger('pettycash_id')->nullable();
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('saldo_awals_id')->references('id')->on('saldo_awals')->onDelete('cascade');
            $table->foreign('cpj_id')->references('id')->on('cpjs')->onDelete('cascade');
            $table->foreign('crj_id')->references('id')->on('crjs')->onDelete('cascade');
            $table->foreign('purchasejournal_id')->references('id')->on('purchase_journals')->onDelete('cascade');
            $table->foreign('salesjournal_id')->references('id')->on('sales_journals')->onDelete('cascade');
            $table->foreign('retur_penjualan_id')->references('id')->on('retur_penjualans')->onDelete('cascade');
            $table->foreign('retur_pembelian_id')->references('id')->on('retur_pembelians')->onDelete('cascade');
            $table->foreign('cash_bank_outs_id')->references('id')->on('cash_bank_outs')->onDelete('cascade');
            $table->foreign('cash_bank_ins_id')->references('id')->on('cash_bank_ins')->onDelete('cascade');
            $table->foreign('jurnal_umums_id')->references('id')->on('jurnal_umums')->onDelete('cascade');
            $table->foreign('pettycash_id')->references('id')->on('pettycashes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_buku_besars');
    }
}
