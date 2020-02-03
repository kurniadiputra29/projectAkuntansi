<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldo_items', function (Blueprint $table) {
            $table->Increments('id');
            $table->date('tanggal');
            $table->unsignedInteger('items_id');
            $table->integer('unit');
            $table->integer('price');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saldo_items');
    }
}
