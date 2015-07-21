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

            $table->integer('room')->unsigned();
            $table->foreign('room')->references('id')->on('rooms');

            $table->integer('table_type')->unsigned();
            $table->foreign('table_type')->references('id')->on('table_types');


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
