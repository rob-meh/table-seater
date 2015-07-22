<?php

use Illuminate\Database\Seeder;
use App\Models\Guest;
use App\Models\MenuItem;

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
            $guest->menu_item_id = rand(1,3);
            $guest->save();
        }
    }
}
