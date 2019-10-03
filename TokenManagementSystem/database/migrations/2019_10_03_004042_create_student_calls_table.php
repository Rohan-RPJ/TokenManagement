<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('submission_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->timestamps();

            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_calls');
    }
}
