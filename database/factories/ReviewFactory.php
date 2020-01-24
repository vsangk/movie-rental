<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'film_id' => factory(App\Film::class),
        'rating' => $faker->numberBetween(1, 5),
        'comment' => $faker->sentence(8),
    ];
});
