<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Guest;
use App\Models\GuestDietaryRestriction;
class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,150) as $index) {
            $guest = new Guest();
            $guest->email = $faker->email;
            $guest->first_name = $faker->firstName;
            $guest->last_name = $faker->lastName;
            $guest->event_id =1;
            if(Guest::all()->count() > 0)
            {
                if(is_int($index/10))
                {
                    $guest->plus_one = $index-1;
                }
            }

            $guest->save();

            if(is_int($index/30))
            {
               $gdr = new GuestDietaryRestriction();
               $gdr->guest_id = $guest->id;
               $gdr->dietary_restriction_id = rand(1,3);
               $gdr->save();
            }
        }
    }
}
