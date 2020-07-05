<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(\App\EventUser::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $user->syncRoles('student');
    $event= factory(App\Event::class)->create();
    return [
        'event_id' => $event->id,
        'user_id' => $user->id,
    ];

});
