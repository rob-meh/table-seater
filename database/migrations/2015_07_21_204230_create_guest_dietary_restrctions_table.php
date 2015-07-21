<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestDietaryRestrctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_dietary_restrictions',function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests');

            $table->integer('restriction_id')->unsigned();
            $table->foreign('restriction_id')->references('id')->on('dietary_restrictions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('guest_dietary_restrictions');
        
    }
}
