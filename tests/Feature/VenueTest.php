<?php

namespace Tests\Feature;

use App\User;
use App\Venue;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VenueTest extends TestCase
{
    use WithFaker;

    public function testVenueIndexSuperAdminAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $response = $this->actingAs($user)->get(route('venues.index'));

        $response->assertStatus(200);
    }

    public function testVenueIndexCommunityAdminAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('community-admin');

        $response = $this->actingAs($user)->get(route('venues.index'));

        $response->assertStatus(403);
    }

    public function testVenueIndexStudentAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('student');

        $response = $this->actingAs($user)->get(route('venues.index'));

        $response->assertStatus(403);
    }

    public function testVenueCreation()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $name = $this->faker->name;
        $description = $this->faker->text($maxNbChars = 200);
        $capacity = $this->faker->numberBetween($min = 30, $max = 12000);
        $air_conditioned = true;
        $active = true;
        $venue_image_path = null;

        $response = $this->actingAs($user)->post(route('venues.store'), [
            'name' => $name,
            'description' => $description,
            'capacity' => $capacity,
            'air_conditioned' => $air_conditioned,
            'active' => $active,
            'venue_image_path' => $venue_image_path,
        ]);

        $response->assertRedirect(route('venues.index'));

        $this->assertDatabaseHas('venues', [
            'name' => $name,
            'description' => $description,
            'capacity' => $capacity,
            'air_conditioned' => $air_conditioned,
            'active' => $active,
            'venue_image_path' => $venue_image_path,
        ]);
    }

    public function testVenueUpdate()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $venue = factory(Venue::class)->create();

        $name = $this->faker->name;
        $description = $this->faker->text($maxNbChars = 200);
        $capacity = $this->faker->numberBetween($min = 30, $max = 12000);
        $air_conditioned = true;
        $active = true;
        $venue_image_path = null;

        $response = $this->actingAs($user)->put(route('venues.update', $venue), [
            'name' => $name,
            'description' => $description,
            'capacity' => $capacity,
            'air_conditioned' => $air_conditioned,
            'active' => $active,
            'venue_image_path' => $venue_image_path,
        ]);

        $response->assertRedirect(route('venues.index'));

        $this->assertDatabaseHas('venues', [
            'name' => $name,
            'description' => $description,
            'capacity' => $capacity,
            'air_conditioned' => $air_conditioned,
            'active' => $active,
            'venue_image_path' => $venue_image_path,
        ]);
    }

    public function testVenueDeletion()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $venue = factory(Venue::class)->create();

        $response = $this->actingAs($user)->delete(route('venues.destroy', $venue));

        $response->assertRedirect(route('venues.index'));
    }

    public function testVenueApi()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $response = $this->actingAs($user)->post(route('ajax.venues.index'));

        $response->assertStatus(200);
    }
}
