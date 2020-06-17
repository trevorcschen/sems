<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    public function testUserIndexSuperAdminAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(200);
    }

    public function testUserIndexCommunityAdminAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('community-admin');

        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(403);
    }

    public function testUserIndexStudentAccess()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('student');

        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(403);
    }

    public function testUserCreation()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $name = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        $student_id = $this->faker->bothify('P????????');
        $ic_number = $this->faker->numerify('######-##-####');
        $phone_number = $this->faker->numerify('##########');
        $biography = $this->faker->text($maxNbChars = 200);
        $profile_image_path = null;
        $active = true;
        $role = Role::where('name', 'super-admin')->first()->id;

        $response = $this->actingAs($user)->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'student_id' => $student_id,
            'ic_number' => $ic_number,
            'phone_number' =>  $phone_number,
            'biography' => $biography,
            'profile_image_path' => $profile_image_path,
            'password' => 'passwordpasswordpasswordpassword',
            'password_confirmation' => 'passwordpasswordpasswordpassword',
            'role' => $role,
            'active' => $active,
        ]);

        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
            'student_id' => $student_id,
            'ic_number' => $ic_number,
            'phone_number' =>  $phone_number,
            'biography' => $biography,
            'profile_image_path' => $profile_image_path,
            'active' => $active,
        ]);
    }

    public function testUserUpdate()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $user1 = factory(User::class)->create();

        $name = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        $student_id = $this->faker->bothify('P????????');
        $ic_number = $this->faker->numerify('######-##-####');
        $phone_number = $this->faker->numerify('##########');
        $biography = $this->faker->text($maxNbChars = 200);
        $profile_image_path = null;
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $active = true;
        $role = Role::where('name', 'super-admin')->first()->id;
        $email_verified_at = now();
        $remember_token = Str::random(10);

        $response = $this->actingAs($user)->put(route('users.update', $user1), [
            'name' => $name,
            'email' => $email,
            'student_id' => $student_id,
            'ic_number' => $ic_number,
            'phone_number' =>  $phone_number,
            'biography' => $biography,
            'profile_image_path' => $profile_image_path,
            'password' => 'passwordpasswordpasswordpassword',
            'password_confirmation' => 'passwordpasswordpasswordpassword',
            'role' => $role,
            'active' => $active,
        ]);

        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
            'student_id' => $student_id,
            'ic_number' => $ic_number,
            'phone_number' =>  $phone_number,
            'biography' => $biography,
            'profile_image_path' => $profile_image_path,
            'active' => $active,
        ]);
    }

    public function testUserDeletion()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $user1 = factory(User::class)->create();

        $response = $this->actingAs($user)->delete(route('users.destroy', $user1));

        $response->assertRedirect(route('users.index'));
    }

    public function testUserApi()
    {
        $user = factory(User::class)->create();
        $user->syncRoles('super-admin');

        $response = $this->actingAs($user)->post(route('ajax.users.index'));

        $response->assertStatus(200);
    }
}
