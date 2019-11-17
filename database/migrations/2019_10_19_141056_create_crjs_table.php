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
            $table->string('kode')->unique();
            $table->unsignedInteger('customers_id');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('customers_id')->references('id')->on('data_customers')->onDelete('cascade');
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
