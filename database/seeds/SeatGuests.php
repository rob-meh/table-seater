<?php

use Illuminate\Database\Seeder;
use App\Models\Guest;
use App\Models\Table;
class SeatGuests extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guestChunks = Guest::all()->chunk(6,true);
        foreach ($guestChunks as $index => $chunk) {
            $table = Table::find($index+1);
            foreach ($chunk as $guest) {
                $table->seatGuest($guest);
            }
        }
    }
}
