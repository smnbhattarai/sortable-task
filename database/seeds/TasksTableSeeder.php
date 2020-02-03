<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $range = range(10, 90, 5);
        foreach($range as $position) {
            DB::table('tasks')->insert([
                'title' => $faker->words(rand(2, 5), true),
                'position' => $position,
            ]);
        }
    }
}
