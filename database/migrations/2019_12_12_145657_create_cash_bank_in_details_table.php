<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBankInDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_bank_in_details', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('cash_bank_ins_id');
            $table->string('nomor_akun');
            $table->string('nama_akun');
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('cash_bank_in_details');
    }
}
