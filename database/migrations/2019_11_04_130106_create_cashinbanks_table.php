<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashinbanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashinbanks', function (Blueprint $table) {
            $table->Increments('id');
            $table->date('tanggal');
            $table->string('kode')->unique();
            $table->string('penerima_diterima');
            $table->text('description')->nullable();
            $table->boolean('status')->nullable();
            
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
        Schema::dropIfExists('cashinbanks');
    }
}
