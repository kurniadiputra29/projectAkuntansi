<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->Increments('id');
            $table->date('tanggal');
            $table->unsignedInteger('items_id')->nullable();
            $table->unsignedInteger('saldo_items_id')->nullable();
            $table->unsignedInteger('crj_id')->nullable();
            $table->unsignedInteger('cpj_id')->nullable();
            $table->unsignedInteger('purchasejournal_id')->nullable();
            $table->unsignedInteger('salesjournal_id')->nullable();
            $table->unsignedInteger('retur_penjualan_id')->nullable();
            $table->unsignedInteger('retur_pembelian_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('unit');
            $table->integer('price');
            $table->integer('total');
            $table->integer('sales')->nullable();
            $table->timestamps();

            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('saldo_items_id')->references('id')->on('saldo_items')->onDelete('cascade');
            $table->foreign('cpj_id')->references('id')->on('cpjs')->onDelete('cascade');
            $table->foreign('crj_id')->references('id')->on('crjs')->onDelete('cascade');
            $table->foreign('purchasejournal_id')->references('id')->on('purchase_journals')->onDelete('cascade');
            $table->foreign('salesjournal_id')->references('id')->on('sales_journals')->onDelete('cascade');
            $table->foreign('retur_penjualan_id')->references('id')->on('retur_penjualans')->onDelete('cascade');
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
        Schema::dropIfExists('inventories');
    }
}
