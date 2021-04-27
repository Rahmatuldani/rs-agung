<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medic_records', function (Blueprint $table) {
            $table->string('medrec_id')->primary();
            $table->integer('patient_id');
            $table->integer('user_id');
            $table->string('complaint', 500);
            $table->string('action', 500);
            $table->string('status', 100);
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
        Schema::dropIfExists('medic_records');
    }
}
