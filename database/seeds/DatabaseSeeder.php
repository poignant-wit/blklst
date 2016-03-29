<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(RolesPermissionsTablesSeeder::class);
         $this->call(RatingsTableSeeder::class);
//         $this->call(CommentsTableSeeder::class);
    }
}
