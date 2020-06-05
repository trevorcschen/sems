<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Venue;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Venue::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 200),
        'capacity' => $faker->numberBetween($min = 30, $max = 12000),
        'air_conditioned' => true,
        'active' => true,
        'venue_image_path' => null,
    ];
});
