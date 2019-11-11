<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashinbankdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashinbankdetails', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('cashinbank_id');
            $table->string('nomor_akun');
            $table->string('nama');
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();

            $table->foreign('cashinbank_id')->references('id')->on('cashinbanks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashinbankdetails');
    }
}
