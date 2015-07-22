<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User();

        $newUser->email= 'test@example.com';
        $newUser->name= 'John Doe';
        $newUser->password = Hash::make('password');
        $newUser->save();
    }
}
