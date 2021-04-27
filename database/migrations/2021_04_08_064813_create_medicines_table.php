<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->string('batch_id', 50)->primary();
            $table->integer('type_id');
            $table->string('medicine_name');
            $table->integer('medicine_stock');
            $table->integer('medicine_price');
            $table->timestamps();

            $table->foreign('type_id')->references('type_id')->on('medicine_types')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
