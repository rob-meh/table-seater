<?php

use Illuminate\Database\Seeder;
use App\Models\DietaryRestriction;

class DietaryRestrictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DietaryRestriction::create([
            'restriction'=>'Vegetarian'
            ]);
        DietaryRestriction::create([
            'restriction'=>'Vegan'
            ]);
        DietaryRestriction::create([
            'restriction'=>'Peanut Allergy'
            ]);

    }
}
