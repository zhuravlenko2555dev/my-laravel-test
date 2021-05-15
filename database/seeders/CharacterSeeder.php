<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
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

        $portrayers = [];
        $portrayers['m'] = [];
        $portrayers['f'] = [];
        for ($s = 0; $s < 35; $s++) {
            if ($faker->boolean) {
                array_push($portrayers['m'], $faker->firstNameMale . ' ' . $faker->lastName);
            } else {
                array_push($portrayers['f'], $faker->firstNameFemale . ' ' . $faker->lastName);
            }
        }

        for ($i = 1; $i <= 100; $i++) {
            $occupations = [];
            for ($p = 0; $p <= 3; $p++) {
                array_push($occupations, $faker->jobTitle);
            }

            $character = [
                'id' => $i,
                'birthday' => $faker->dateTimeBetween('-45 years', '-25 years'),
                'occupations' => json_encode($occupations),
                'img' => 'character_' . $i . '.jpg',
                'nickname' => $faker->userName,
            ];

            if ($faker->boolean) {
                $character['name'] = $faker->firstNameMale . ' ' . $faker->lastName;
                $character['portrayed'] = Arr::random($portrayers['m']);
            } else {
                $character['name'] = $faker->firstNameFemale . ' ' . $faker->lastName;
                $character['portrayed'] = Arr::random($portrayers['f']);
            }

            array_push($data, $character);
        }

        DB::table('characters')->insert($data);

        $characters_episodes = [];
        $quotes = [];
        for ($z = 1; $z <= 30; $z++) {
            foreach (Arr::random($data, $faker->numberBetween(5, 15)) as $ch) {
                $ce_item = [
                    'character_id' => $ch['id'],
                    'episode_id' => $z,
                ];

                array_push($characters_episodes, $ce_item);

                for ($q = 0; $q < $faker->numberBetween(3, 7); $q++) {
                    $quote_item = [
                        'quote' => $faker->sentence(10),
                        'episode_id' => $z,
                        'character_id' => Arr::random($data)['id'],
                    ];

                    array_push($quotes, $quote_item);
                }
            }
        }

        DB::table('character_episode')->insert($characters_episodes);
        DB::table('quotes')->insert($quotes);
    }
}
