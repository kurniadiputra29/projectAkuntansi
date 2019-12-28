<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_pembelians', function (Blueprint $table) {
          $table->Increments('id');
          $table->date('tanggal');
          $table->string('kode')->unique();
          $table->unsignedInteger('suppliers_id');
          $table->unsignedInteger('cpj_id')->nullable();
          $table->unsignedInteger('purchasejournal_id')->nullable();
          $table->text('description')->nullable();
          $table->timestamps();

          $table->foreign('suppliers_id')->references('id')->on('data_suppliers')->onDelete('cascade');
          $table->foreign('cpj_id')->references('id')->on('cpjs')->onDelete('cascade');
          $table->foreign('purchasejournal_id')->references('id')->on('purchase_journals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retur_pembelians');
    }
}
