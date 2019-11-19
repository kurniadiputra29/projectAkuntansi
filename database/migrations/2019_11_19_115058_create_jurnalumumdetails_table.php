<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalumumdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnalumumdetails', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('jurnal_umums_id');
            $table->string('nomor_akun');
            $table->string('nama_akun');
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();

            $table->foreign('jurnal_umums_id')->references('id')->on('jurnal_umums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnalumumdetails');
    }
}
