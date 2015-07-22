<?php

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chicken = new MenuItem();
        $chicken->name= "Chicken";
        $chicken->menu_id =1;
        $chicken->save();

        $fish = new MenuItem();
        $fish->name= "Fish";
        $fish->menu_id =1;
        $fish->save();

        $salad = new MenuItem();
        $salad->name= "Salad";
        $salad->menu_id =1;
        $salad->save();
    }
}
