<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->insert([
            'role_id' => Role::where('name', 'admin')->first()->id,
            'permission_id' => Permission::where('name', 'show_comments')->first()->id,
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => Role::where('name', 'admin')->first()->id,
            'permission_id' => Permission::where('name', 'edit_comments')->first()->id,
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => Role::where('name', 'admin')->first()->id,
            'permission_id' => Permission::where('name', 'delete_comments')->first()->id,
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => Role::where('name', 'candidate')->first()->id,
            'permission_id' => Permission::where('name', 'show_comments')->first()->id,
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => Role::where('name', 'recruiter')->first()->id,
            'permission_id' => Permission::where('name', 'show_comments')->first()->id,
        ]);






//        DB::table('role_permissions')->insert([
//            'role_id' => '1',
//            'permission_id' => '2',
//        ]);
//        DB::table('role_permissions')->insert([
//            'role_id' => '1',
//            'permission_id' => '3',
//        ]);
    }
}
