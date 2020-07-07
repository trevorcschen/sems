<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => preg_replace('/@example\..*/', '@student.newinti.edu.my', $faker->unique()->email),
        'student_id' => $faker->bothify('P????????'),
        'ic_number' => $faker->numerify('######-##-####'),
        'phone_number' => $faker->numerify('###-#######'),
        'biography' => $faker->text($maxNbChars = 200),
        'profile_image_path' => null,
        'password' => Hash::make('adminadminadminadmin'),
        'active' => $faker->boolean,
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
        'created_at' => $faker->dateTimeBetween('-1 month', '+1 month'),
    ];
});

