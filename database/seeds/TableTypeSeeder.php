<?php

use Illuminate\Database\Seeder;
use App\Models\TableType;
class TableTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rectTable = new TableType();
        $rectTable->type = "Rectangle";
        $rectTable->save();

        $rectTable = new TableType();
        $rectTable->type = "Circle";
        $rectTable->save();
    }
}
