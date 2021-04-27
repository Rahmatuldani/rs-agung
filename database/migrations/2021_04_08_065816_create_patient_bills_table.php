<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_bills', function (Blueprint $table) {
            $table->string('medrec_id');
            $table->string('medicine_id');
            $table->integer('amount');
            $table->integer('subtotal');
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('medrec_id')->references('medrec_id')->on('medic_records')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('medicine_id')->references('batch_id')->on('medicines')->onUpdate('cascade')
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
        Schema::dropIfExists('patient_bills');
    }
}
