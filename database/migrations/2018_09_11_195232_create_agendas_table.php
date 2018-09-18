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
            $table->foreign('meeting_id')->references('id')->on('meetings');
            $table->string('topic');
            $table->text('description');
            $table->unsignedInteger('time_allocated');
            $table->unsignedInteger('presenter');
            $table->unsignedInteger('owner');
//            $table->enum('agenda_status', ['Adopted', 'Rejected']);
            $table->tinyInteger('agenda_status')->default(0);
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
