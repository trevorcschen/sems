<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use App\Venue;
use Faker\Generator as Faker;

$factory->define(\App\Event::class, function (Faker $faker) {

    $start_date = $faker->dateTimeBetween('+0 days', '+1 month');
    $start_date_clone = clone $start_date;
    $end_date = $faker->dateTimeBetween($start_date, $start_date_clone->modify('+5 hours'));
    $venue = factory(Venue::class)->create();
    $community = factory(\App\Community::class)->create();
    return [
        'name' => $faker->sentence,
        'description' => $faker->text($maxNbChars = 200),
        'start_time' => $start_date,
        'end_time' => $end_date,
        'image_URL' => 'd' ,
        'max_participants' => $faker->numberBetween($min = 50, $max = 1200),
        'fee' =>$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5),
        'community_id' => $community->id,
        'venue_id' => $venue->id,
        'user_id' => $community->admin->id,
        'active' => true,
        'eventTag' => substr($faker->uuid ,0,10),
        //
    ];
});
