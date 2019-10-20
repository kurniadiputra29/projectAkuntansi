<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_suppliers', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('kode');
            $table->string('nama');
            $table->string('npwp')->null();
            $table->string('alamat');
            $table->string('termin');
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
        Schema::dropIfExists('data_suppliers');
    }
}
