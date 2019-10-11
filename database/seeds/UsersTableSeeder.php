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
                    'username' => "ian",
                    'name' => "Ian Travers",
                    'email' => 'ian@vdpv.lan',
                    'is_admin' => true,
                    'password' => bcrypt('1111'),
                ],
                [
                    'name' => "{$faker->firstName} {$faker->lastName}",
                    'username' => "{$faker->firstName} {$faker->lastName}",
                    'email' => 'fake01@vdpv.lan',
                    'is_admin' => false,
                    'password' => bcrypt('1111'),
                ],
                [
                    'name' => "{$faker->firstName} {$faker->lastName}",
                    'username' => "{$faker->firstName} {$faker->lastName}",
                    'email' => 'fake02@vdpv.lan',
                    'is_admin' => false,
                    'password' => bcrypt('1111'),
                ],
            ]);
        } else {
            DB::table('users')->insert([
                [
                    'username' => "sa",
                    'name' => 'SA',
                    'is_admin' => true,
                    'email' => 'program@plck.rw',
                    'password' => bcrypt('1111'),
                ],
                [
                    'username' => "adm",
                    'name' => 'Администратор станции',
                    'is_admin' => false,
                    'email' => 'fake@vtb.rw',
                    'password' => bcrypt('7112'),
                ]

            ]);
        }
    }
}
