<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_penjualans', function (Blueprint $table) {
          $table->Increments('id');
          $table->date('tanggal');
          $table->string('kode')->unique();
          $table->unsignedInteger('customers_id');
          $table->unsignedInteger('crj_id')->nullable();
          $table->unsignedInteger('salesjournal_id')->nullable();
          $table->text('description')->nullable();
          $table->timestamps();

          $table->foreign('customers_id')->references('id')->on('data_customers')->onDelete('cascade');
          $table->foreign('crj_id')->references('id')->on('crjs')->onDelete('cascade');
          $table->foreign('salesjournal_id')->references('id')->on('sales_journals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retur_penjualans');
    }
}
