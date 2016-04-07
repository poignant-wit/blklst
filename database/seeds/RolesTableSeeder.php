<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'label' => 'Admin of site',
        ]);

        DB::table('roles')->insert([
            'name' => 'candidate',
            'label' => 'User of site',
        ]);

        DB::table('roles')->insert([
            'name' => 'recruiter',
            'label' => 'Recruiter of site',
        ]);

    }
}
