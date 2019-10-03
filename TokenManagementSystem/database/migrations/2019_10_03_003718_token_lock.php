<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TokenLock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tokenlock', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('submission_id')->unsigned();
            $table->foreign('submission_id')->references('id')->on('submissions');

            $table->bigInteger('round_id')->unsigned();

            $table->boolean("locked")->default(false);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('tokenlock');
    }
}
