<?php

use Illuminate\Database\Seeder;
use App\Models\Table;
use App\Models\Room;
class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,25) as $index) {
        	$table = new Table();
        	$table->number_of_seats=6;
        	$table->table_name = 'Table '.$index;
        	$table->room_id = 1;
        	$table->table_type_id = 2;
        	$table->width = 6;
        	$table->save();
            
        }
    }
}
