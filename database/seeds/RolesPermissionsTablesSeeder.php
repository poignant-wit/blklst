<?php

use Illuminate\Database\Seeder;

class RolesPermissionsTablesSeeder extends Seeder
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
            'name' => 'user',
            'label' => 'User of site',
        ]);

        DB::table('roles')->insert([
            'name' => 'recruiter',
            'label' => 'Recruiter of site',
        ]);

        DB::table('permissions')->insert([
            'name' => 'show_comments',
        ]);

        DB::table('permissions')->insert([
            'name' => 'edit_comments',
        ]);

        DB::table('permissions')->insert([
            'name' => 'delete_comments',
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '1',
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '2',
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '3',
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => '2',
            'permission_id' => '1',
        ]);

        DB::table('user_role')->insert([
            'user_id' => '1',
            'role_id' => '1',
        ]);



    }
}
