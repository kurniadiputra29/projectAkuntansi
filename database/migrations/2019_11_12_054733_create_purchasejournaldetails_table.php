<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatepurchasejournaldetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasejournaldetails', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('purchasejournal_id');
            $table->string('nomor_akun');
            $table->string('nama_akun');
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();

            $table->foreign('purchasejournal_id')->references('id')->on('purchase_journals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchasejournaldetails');
    }
}
