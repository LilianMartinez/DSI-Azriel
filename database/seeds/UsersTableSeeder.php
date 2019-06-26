<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=> 'irwin',
            'email'=> 'irwin@ues.com',
            'password'=> bcrypt('1234'),

        ]);
    }
}
