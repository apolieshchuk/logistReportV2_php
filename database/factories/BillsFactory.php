<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bills;
use Faker\Generator as Faker;

$factory->define(Bills::class, function (Faker $faker) {
    return [
        'num' => $faker->numberBetween(0,1000),
        'bills_date' => $faker->dateTime('now'),
        'sum' => $faker->numberBetween(255,300000),
        'originals_date' => $faker->dateTime('now'),
        'carrier_id' => $faker->numberBetween(1,300),
        'payed_date' => $faker->dateTime('now'),
        'notes' => $faker->asciify('*************'),
        'approval_date' => $faker->dateTime('now'),
        'payer_id' => $faker->numberBetween(18,27),
        'route_id' => $faker->numberBetween(1,150),
    ];
});
