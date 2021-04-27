<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_reports', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('fracture_id')->nullable();
            $table->string('type');
            $table->integer('distributor_id')->nullable();
            $table->string('medicine_id');
            $table->integer('first_stock');
            $table->integer('last_stock');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('medicine_id')->references('batch_id')->on('medicines')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('distributor_id')->references('distributor_id')->on('distributors')->onUpdate('cascade')
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
        Schema::dropIfExists('log_reports');
    }
}
