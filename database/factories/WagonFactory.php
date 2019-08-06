<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Wagon;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Wagon::class, function (Faker $faker) {
    return [
        'inw' => $faker->numerify('########'),
        'arrived_at' => Carbon::parse('-2 hours'),
        'detained_at' => Carbon::parse('-1 hours'),
        'released_at' => null,
        'departed_at' => null,
        'detained_by' => Arr::random(array_keys(Wagon::$detainers)),
        'reason' => $faker->sentence(4),
        'cargo' => $faker->jobTitle,
        'forwarder' => $faker->jobTitle,
        'ownership' => $faker->buildingNumber,
        'departure_station' => $faker->city,
        'destination_station' => $faker->city,
        'taken_measure' => $faker->paragraph(2),
        'creator_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
