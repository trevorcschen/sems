<?php

namespace Tests\Feature;

use App\Community;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    use WithFaker;

    public function testCommunityIndexSuperAdminAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $response = $this->actingAs($user)->get(route('communities.index'));

        $response->assertStatus(200);
    }

    public function testCommunityIndexCommunityAdminAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('community-admin');

        $response = $this->actingAs($user)->get(route('communities.index'));

        $response->assertStatus(200);
    }

    public function testCommunityIndexStudentAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('student');

        $response = $this->actingAs($user)->get(route('communities.index'));

        $response->assertStatus(200);
    }

    public function testCommunityCreation()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $name = $this->faker->name;
        $description = $this->faker->text($maxNbChars = 200);
        $fee = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5);
        $max_members = $this->faker->numberBetween($min = 50, $max = 1200);
        $logo_path = null;
        $active = true;

        $response = $this->actingAs($user)->post(route('communities.store'), [
            'name' => $name,
            'description' => $description,
            'fee' => $fee,
            'max_members' => $max_members,
            'logo_path' => $logo_path,
            'active' => $active,
            'admin' => $user->id,
        ]);

        $response->assertRedirect(route('communities.index'));

        $this->assertDatabaseHas('communities', [
            'name' => $name,
            'description' => $description,
            'fee' => $fee,
            'max_members' => $max_members,
            'logo_path' => $logo_path,
            'active' => $active,
            'user_id' => $user->id,
        ]);
    }

    public function testCommunityUpdate()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $userStudent = factory(User::class)->create();
        $userStudent->syncRoles('student');

        $community = factory(Community::class)->create();

        $name = $this->faker->name;
        $description = $this->faker->text($maxNbChars = 200);
        $fee = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5);
        $max_members = $this->faker->numberBetween($min = 50, $max = 1200);
        $logo_path = null;
        $active = true;

        $response = $this->actingAs($user)->put(route('communities.update', $community), [
            'name' => $name,
            'description' => $description,
            'fee' => $fee,
            'max_members' => $max_members,
            'logo_path' => $logo_path,
            'active' => $active,
            'admin' => $userStudent->id,
        ]);

        $response->assertRedirect(route('communities.index'));

        $this->assertDatabaseHas('communities', [
            'name' => $name,
            'description' => $description,
            'fee' => $fee,
            'max_members' => $max_members,
            'logo_path' => $logo_path,
            'active' => $active,
            'user_id' => $userStudent->id,
        ]);
    }

    public function testCommunityDeletion()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $community = factory(Community::class)->create();

        $response = $this->actingAs($user)->delete(route('communities.destroy', $community));

        $response->assertRedirect(route('communities.index'));
    }

    public function testCommunityApi()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $response = $this->actingAs($user)->post(route('ajax.communities.index'));

        $response->assertStatus(200);
    }
}
