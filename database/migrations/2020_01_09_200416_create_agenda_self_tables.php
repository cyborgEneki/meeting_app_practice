<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaSelfTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_self', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agendatarget_id');
            $table->foreign('agendatarget_id')->references('id')->on('agendas');
            $table->unsignedInteger('agendasource_id');
            $table->foreign('agendasource_id')->references('id')->on('agendas');
            $table->string('vote');
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
        Schema::dropIfExists('agenda_self');
    }
}
