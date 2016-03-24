<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'name',
            'email' => 'anatoliymandrichenko@gmail.com',
            'password' => bcrypt('1234'),
        ]);

    }
}
