<?php

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Event;
class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $room = new Room();
        $room->event_id = Event::all()->first()->id;
        $room->length = 200;
        $room->width = 400;
        //need 25 tables of 6 people

        $room->save();
    }
}
