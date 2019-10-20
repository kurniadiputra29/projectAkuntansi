<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crjs', function (Blueprint $table) {
            $table->Increments('id');
            $table->date('tanggal');
            $table->string('kode');
            $table->text('description');
            $table->string('nomor_akun');
            $table->integer('debet');
            $table->integer('kredit');
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
        Schema::dropIfExists('crjs');
    }
}
