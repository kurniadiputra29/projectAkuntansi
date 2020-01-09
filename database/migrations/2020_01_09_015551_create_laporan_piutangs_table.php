<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_piutangs', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('customers_id');
            $table->unsignedInteger('saldo_piutangs_id')->nullable();
            $table->unsignedInteger('salesjournal_id')->nullable();
            $table->unsignedInteger('retur_penjualan_id')->nullable();
            $table->unsignedInteger('cash_bank_ins_id')->nullable();
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();

            $table->foreign('customers_id')->references('id')->on('data_customers')->onDelete('cascade');
            $table->foreign('saldo_piutangs_id')->references('id')->on('saldo_piutangs')->onDelete('cascade');
            $table->foreign('salesjournal_id')->references('id')->on('sales_journals')->onDelete('cascade');
            $table->foreign('retur_penjualan_id')->references('id')->on('retur_penjualans')->onDelete('cascade');
            $table->foreign('cash_bank_ins_id')->references('id')->on('cash_bank_ins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_piutangs');
    }
}
