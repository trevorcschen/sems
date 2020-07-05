<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Community;
use App\User;
use Faker\Generator as Faker;

$factory->define(Community::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $user->syncRoles('community-admin');

    return [
        'name' => $faker->company,
        'description' => $faker->text($maxNbChars = 200),
        'fee' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5),
        'max_members' => $faker->numberBetween($min = 50, $max = 1200),
        'logo_path' => null,
        'active' => $faker->boolean,
        'user_id' => $user->id,
    ];
});
