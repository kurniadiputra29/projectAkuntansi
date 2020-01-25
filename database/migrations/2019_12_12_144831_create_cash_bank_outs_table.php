<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBankOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_bank_outs', function (Blueprint $table) {
            $table->Increments('id');
            $table->date('tanggal');
            $table->string('kode')->unique();
            $table->string('dibayar_ke')->nullable();
            $table->unsignedInteger('suppliers_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('suppliers_id')->references('id')->on('data_suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_bank_outs');
    }
}
