<?php

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->insert([
            'name' => 'Хороший',
            'label' => 'Хороший отзыв',
        ]);
        DB::table('ratings')->insert([
            'name' => 'Средний',
            'label' => 'Средний отзыв',
        ]);
        DB::table('ratings')->insert([
            'name' => 'Плохой',
            'label' => 'Плохой отзыв',
        ]);
    }
}
