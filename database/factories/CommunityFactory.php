<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Community;
use App\User;
use Faker\Generator as Faker;

$factory->define(Community::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 200),
        'fee' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL),
        'max_members' => $faker->numberBetween($min = 50, $max = 1200),
        'logo_path' => null,
        'active' => true,
        'user_id' => factory(User::class),
    ];
});
