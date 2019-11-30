<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('items_id');
            $table->unsignedInteger('cpj_id')->nullable();
            $table->unsignedInteger('crj_id')->nullable();
            $table->unsignedInteger('purchasejournal_id')->nullable();
            $table->unsignedInteger('salesjournal_id')->nullable();
            $table->string('status');
            $table->integer('unit');
            $table->integer('price');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('cpj_id')->references('id')->on('cpjs')->onDelete('cascade');
            $table->foreign('crj_id')->references('id')->on('crjs')->onDelete('cascade');
            $table->foreign('purchasejournal_id')->references('id')->on('purchase_journals')->onDelete('cascade');
            $table->foreign('salesjournal_id')->references('id')->on('sales_journals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
