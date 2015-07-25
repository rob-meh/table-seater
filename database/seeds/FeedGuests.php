<?php

use Illuminate\Database\Seeder;
use App\Models\Guest;
use App\Models\MenuItem;
use App\Models\GuestMenuItem;
class FeedGuests extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach (Guest::all() as $guest) {
            $itemChoice = rand(1,3);
            $guestMenuItem  = new GuestMenuItem();
            $guestMenuItem->guest_id = $guest->id;
            $guestMenuItem->menu_item_id = $itemChoice;
            $guestMenuItem->save();
        }
    }
}
