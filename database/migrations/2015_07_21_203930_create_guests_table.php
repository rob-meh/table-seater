<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('first_name');
            $table->string('last_name');

            $table->integer('plus_one')->unsigned()->nullable();
            $table->foreign('plus_one')->references('id')->on('guests');

            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('events');

            $table->integer('table_id')->unsigned()->nullable();
            $table->foreign('table_id')->references('id')->on('tables');
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
        Schema::drop('guests');
    }
}
