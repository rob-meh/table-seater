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
            $table->boolean('has_plus_one')->default(false);

            $table->integer('plus_one')->unsigned();
            $table->foreign('plus_one')->references('id')->on('guests');


            $table->integer('table_id')->unsigned();
            $table->foreign('table_id')->references('id')->on('tables');


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
