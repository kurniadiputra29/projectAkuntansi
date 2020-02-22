<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemetaanAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemetaan_akuns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('inventory')->nullable();
            $table->integer('penjualan_cash')->nullable();
            $table->integer('penjualan_credit')->nullable();
            $table->integer('hpp_penjualan_cash')->nullable();
            $table->integer('hpp_penjualan_credit')->nullable();
            $table->integer('ppn_penjualan')->nullable();
            $table->integer('ppn_pembelian')->nullable();
            $table->integer('pengiriman_penjualan')->nullable();
            $table->integer('pengiriman_pembelian')->nullable();
            $table->integer('diskon_penjualan')->nullable();
            $table->integer('diskon_pembelian')->nullable();
            $table->integer('cash')->nullable();
            $table->integer('hutang')->nullable();
            $table->integer('piutang')->nullable();
            $table->integer('kas_kecil')->nullable();
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
        Schema::dropIfExists('pemetaan_akuns');
    }
}
