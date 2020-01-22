<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Film;
use Faker\Generator as Faker;

$factory->define(Film::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->paragraph,
        'release_year' => $faker->numberBetween(1980, 2020),
        'length' => $faker->numberBetween(10, 240),
    ];
});
