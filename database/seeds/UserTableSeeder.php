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
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'confirmed' => '1',
            'password' => bcrypt('admin'),
        ]);

//        DB::table('users')->insert([
//            'name' => 'recruiter',
//            'email' => 'a@gmail.com',
//            'password' => bcrypt('1234'),
//        ]);
//
//        DB::table('users')->insert([
//            'name' => 'candidat',
//            'email' => 'b@gmail.com',
//            'password' => bcrypt('1234'),
//        ]);

    }
}
