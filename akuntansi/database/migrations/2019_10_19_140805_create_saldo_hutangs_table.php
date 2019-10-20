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
            $table->unsignedInteger('supplier_id');
            $table->integer('keterangan');
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
        Schema::dropIfExists('saldo_hutangs');
    }
}
