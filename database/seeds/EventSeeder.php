<?php

use App\Event;
use App\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Event::class, 1)->create()->each(function ($event)
        {
            $user = factory(User::class)->create();
            $user->syncRoles('student');
            $event->users()->attach($user);
        });

        factory(Event::class, 20)->create([
            'community_id' => 1,
            'venue_id' => 2,
            'user_id' => 2,
        ])->each(function ($event) {
            $user = factory(User::class)->create();
            $user->syncRoles('student');
            $event->users()->attach([$user->id, 3]);
        });

        factory(Event::class, 3)->create([
            'community_id' => 1,
            'venue_id' => 2,
            'user_id' => 2,
        ]);
    }
}
