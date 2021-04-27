<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->integer('patient_id')->autoIncrement();
            $table->string('patient_name');
            $table->char('patient_sex', 2);
            $table->date('patient_birth');
            $table->string('paid_status');
            $table->string('patient_job');
            $table->string('patient_partner');
            $table->string('patient_address');
            $table->string('blood_type');
            $table->string('patient_phone');
            $table->string('religion');
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
