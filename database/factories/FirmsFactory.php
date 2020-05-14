<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Firms;
use Faker\Generator as Faker;

$factory->define(Firms::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->asciify('*******')
    ];
});
