<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_doctors', function (Blueprint $table) {
            $table->integer('patient_id');
            $table->integer('poli_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('patient_id')->references('patient_id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('poli_id')->references('poli_id')->on('polis')->onUpdate('cascade')
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
        Schema::dropIfExists('patient_doctors');
    }
}
