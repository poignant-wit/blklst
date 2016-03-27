<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'owner_id' => '1',
            'target_id' => '2',
            'body' => 'Comment owner 1 about 2',
        ]);

        DB::table('comments')->insert([
            'owner_id' => '1',
            'target_id' => '3',
            'body' => 'Comment owner 1 about 3',
        ]);

        DB::table('comments')->insert([
            'owner_id' => '2',
            'target_id' => '1',
            'body' => 'Comment owner 2 about 1',
        ]);

    }
}
