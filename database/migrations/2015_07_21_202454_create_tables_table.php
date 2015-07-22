<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables',function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('number_of_seats')->nullable();
            $table->string('table_name');
            $table->float('length')->nullable();
            $table->float('width')->nullable();

            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->integer('table_type_id')->unsigned();
            $table->foreign('table_type_id')->references('id')->on('table_types');
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
        Schema::drop('tables');
    }
}
