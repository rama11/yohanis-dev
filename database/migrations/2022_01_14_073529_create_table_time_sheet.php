<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTimeSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_customer');
            $table->integer('id_pid');
            $table->integer('id_user');
            $table->string('activity');
            $table->string('site');
            $table->string('duration');
            $table->string('status');
            $table->string('approved');
            $table->string('submited');
            $table->dateTime('submited_at', 0);
            $table->dateTime('execute_at', 0);
            $table->dateTime('approve_at', 0)->nullable();;
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
        Schema::dropIfExists('time_sheet');
    }
}
