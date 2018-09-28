<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meeting_id');
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');
            $table->string('topic');
            $table->text('description');
            $table->unsignedInteger('time_allocated');
            $table->unsignedInteger('presenter');
            $table->unsignedInteger('owner');
            $table->boolean('agenda_status');
            $table->text('conclusion');
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
        Schema::dropIfExists('agendas');
    }
}
