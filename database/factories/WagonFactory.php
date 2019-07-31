<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Wagon;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Wagon::class, function (Faker $faker) {
    return [
        'inw' => $faker->numerify('########'),
        'arrived_at' => Carbon::parse('-2 hours'),
        'detained_at' => Carbon::parse('-1 hours'),
        'released_at' => null,
        'departed_at' => null,
        'detained_by' => 'Customs',
        'reason' => 'It has no main shipment',
        'cargo' => 'Gasoline',
        'forwarder' => 'BTLS',
        'ownership' => 'BCH',
        'departure_station' => 'Shkirotava',
        'destination_station' => 'Manhali',
        'taken_measure' => 'Nothing',
        'is_empty' => false
    ];
});
