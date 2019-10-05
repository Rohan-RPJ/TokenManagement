<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('participant_id')->unsigned();
            $table->foreign('participant_id')->references('id')->on('participants');

            $table->bigInteger('submission_id')->unsigned();
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');


            $table->bigInteger('round_id')->unsigned();
            $table->timestamps();

            $table->bigInteger('status')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_statuses');
    }
}
