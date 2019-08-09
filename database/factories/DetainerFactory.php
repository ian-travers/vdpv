<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Detainer;

$factory->define(Detainer::class, function () {
    return [
        'name' => 'Таможенная служба',
        'long_detain_event' => 'detained_at'
    ];
});
