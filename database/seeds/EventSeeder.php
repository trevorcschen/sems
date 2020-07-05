<?php

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
        factory(App\Event::class, 1)->create()->each(function ($event)
        {
            $user = factory(App\User::class)->create();
            $user->syncRoles('student');
            $event->users()->sync($user);
        });
    }
}
