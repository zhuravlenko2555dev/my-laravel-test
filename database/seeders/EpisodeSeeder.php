<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $data = [];

        for ($i = 1; $i <= 30; $i++) {
            $episode = [
                'id' => $i,
                'title' => $faker->sentence(5, true),
                'air_date' => $faker->dateTimeBetween('January 20, 2008', 'September 29, 2013'),
            ];

            array_push($data, $episode);
        }

        DB::table('episodes')->insert($data);
    }
}
