<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');

            $table->bigInteger('submission_id')->unsigned();
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');

            $table->bigInteger('value');

            $table->bigInteger('round_id')->unsigned()->default(0);
            //$table->foreign('submission_id')->references('id')->on('submissions');


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
        Schema::dropIfExists('tokens');
    }
}
