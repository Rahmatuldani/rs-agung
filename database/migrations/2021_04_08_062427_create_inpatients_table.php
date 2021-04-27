<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInpatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatients', function (Blueprint $table) {
            $table->integer('inpatient_id')->autoIncrement();
            $table->string('medrec_id');
            $table->integer('user_id');
            $table->integer('patient_id');
            $table->integer('room_id')->nullable();
            $table->string('status');
            $table->integer('service_price');
            $table->timestamps();

            $table->foreign('patient_id')->references('patient_id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('medrec_id')->references('medrec_id')->on('medic_records')->onUpdate('cascade')
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
        Schema::dropIfExists('inpatients');
    }
}
