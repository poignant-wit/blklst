<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'show_comments',
        ]);

        DB::table('permissions')->insert([
            'name' => 'edit_comments',
        ]);

        DB::table('permissions')->insert([
            'name' => 'delete_comments',
        ]);
        DB::table('permissions')->insert([
            'name' => 'add_comments',
        ]);
    }
}
