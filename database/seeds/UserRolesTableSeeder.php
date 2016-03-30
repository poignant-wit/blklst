<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert([
            'user_id' => \App\User::where('name', 'admin')->first()->id,
            'role_id' => \App\Role::where('name', 'admin')->first()->id,
        ]);
    }
}
