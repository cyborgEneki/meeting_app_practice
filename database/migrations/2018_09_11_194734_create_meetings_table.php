<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->unsignedInteger('media_id');
            $table->foreign('media_id')->references('id')->on('media');
            $table->unsignedInteger('meetingtype_id');
            $table->foreign('meetingtype_id')->references('id')->on('meetingtypes');
            $table->unsignedInteger('meetingseries_id');
            $table->foreign('meetingseries_id')->references('id')->on('meetingseries');
            $table->string('name');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->unsignedInteger('chair_id');
            $table->foreign('chair_id')->references('id')->on('users');
            $table->unsignedInteger('secretary_id');
            $table->foreign('secretary_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
