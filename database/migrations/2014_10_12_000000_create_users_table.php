<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('user_id')->autoIncrement();
            $table->string('username');
            $table->string('name')->nullable();
            $table->string('password');
            $table->integer('role_id');
            $table->integer('poli')->nullable();
            $table->tinyInteger('is_actived');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('role_id')->on('roles')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('poli')->references('poli_id')->on('polis')->onUpdate('cascade')
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
        Schema::dropIfExists('users');
    }
}
