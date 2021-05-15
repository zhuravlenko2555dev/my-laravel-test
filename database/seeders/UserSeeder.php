<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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

        for ($i = 1; $i <= 10; $i++) {
            $user = [
                'id' => $i,
                'email' => 'user_' . $i .'@email.com',
                'password' => bcrypt('user1234'),
            ];

            if ($faker->boolean) {
                $user['name'] = $faker->firstNameMale . ' ' . $faker->lastName;
            } else {
                $user['name'] = $faker->firstNameFemale . ' ' . $faker->lastName;
            }

            array_push($data, $user);
        }

        DB::table('users')->insert($data);
    }
}
