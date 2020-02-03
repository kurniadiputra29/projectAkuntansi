<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldoHutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldo_hutangs', function (Blueprint $table) {
            $table->Increments('id');
            $table->date('tanggal');
            $table->unsignedInteger('suppliers_id');
            $table->string('keterangan');
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
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
        Schema::dropIfExists('saldo_hutangs');
    }
}
