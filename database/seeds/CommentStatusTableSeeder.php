<?php

use Illuminate\Database\Seeder;

class CommentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment_status')->insert([
            'name' => 'waiting',
            'label' => 'Wait verification',
        ]);

        DB::table('comment_status')->insert([
            'name' => 'disabled',
            'label' => 'Disabled in search',
        ]);

        DB::table('comment_status')->insert([
            'name' => 'enabled',
            'label' => 'Enabled in search',
        ]);
    }
}
