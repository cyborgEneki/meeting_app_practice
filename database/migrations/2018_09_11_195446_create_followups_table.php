<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agenda_id');
            $table->foreign('agenda_id')->references('id')->on('agendas');
            $table->text('action');
            $table->unsignedInteger('owner');
            $table->dateTime('timeline');
//            $table->enum('status', ['Done', 'Pending']);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('followups');

        Schema::dropIfExists('users');
    }
}
