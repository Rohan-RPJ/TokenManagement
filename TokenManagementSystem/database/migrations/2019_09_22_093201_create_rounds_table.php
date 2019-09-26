<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('round_id')->unsigned()->default(1);
            
            $table->bigInteger('q1')->unsigned();
            $table->foreign('q1')->references('id')->on('questions');
            
            $table->bigInteger('q2')->unsigned();
            $table->foreign('q2')->references('id')->on('questions');
            
            $table->bigInteger('q3')->unsigned();
            $table->foreign('q3')->references('id')->on('questions');
            
            $table->bigInteger('submission_id')->unsigned();
            $table->foreign('submission_id')->references('id')->on('submissions');
            
            $table->bigInteger('participant_id')->unsigned();
            $table->foreign('participant_id')->references('id')->on('participants');

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
        Schema::dropIfExists('rounds');
    }
}
