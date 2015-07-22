<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserSeeder::class); 
        $this->call(TableTypeSeeder::class); 
        $this->call(DietaryRestrictionSeeder::class); 
        $this->call(EventSeeder::class); 
        $this->call(RoomSeeder::class); 
        $this->call(TableSeeder::class); 
        $this->call(GuestSeeder::class); 
        $this->call(SeatGuests::class); 

        Model::reguard();
    }
}
