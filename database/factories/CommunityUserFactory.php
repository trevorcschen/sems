<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(\App\CommunityUser::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $user->syncRoles('student');
    $community = factory(\App\Community::class)->create();
    return [
        //
        'community_id' => $community->id,
        'user_id' => $user->id
    ];
});
