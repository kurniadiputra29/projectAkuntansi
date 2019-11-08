<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettycashDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pettycash_details', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('pettycash_id');
            $table->string('nomor_akun');
            $table->string('nama_akun');
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('pettycash_details');
    }
}
