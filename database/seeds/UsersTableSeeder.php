<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        $faker = Faker\Factory::create('ru_RU');

        if (env('APP_ENV') == 'local') {
            DB::table('users')->insert([
                [
                    'name' => "Ian Travers",
                    'email' => 'ian@dpv.lan',
                    'password' => bcrypt('1111'),
                ],
                [
                    'name' => "{$faker->firstName} {$faker->lastName}",
                    'email' => 'fake01@dpv.lan',
                    'password' => bcrypt('1111'),
                ],
                [
                    'name' => "{$faker->firstName} {$faker->lastName}",
                    'email' => 'fake02@dpv.lan',
                    'password' => bcrypt('1111'),
                ],
            ]);
        } else {
            DB::table('users')->insert([
                'name' => "Ian Travers",
                'email' => 'ian@dpv.lan',
                'password' => bcrypt('1111'),
            ]);
        }
    }
}
