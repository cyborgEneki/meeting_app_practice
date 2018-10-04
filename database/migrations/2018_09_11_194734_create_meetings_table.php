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
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('venue_id')->nullable();
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
            $table->unsignedInteger('creator');
            $table->foreign('creator')->references('id')->on('users');
            $table->unsignedInteger('facilitator');
            $table->foreign('facilitator')->references('id')->on('users');
            $table->unsignedInteger('time_keeper');
            $table->foreign('time_keeper')->references('id')->on('users');
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
        Schema::dropIfExists('meetings');

        Schema::dropIfExists('venues');

        Schema::dropIfExists('media');
    }
}
