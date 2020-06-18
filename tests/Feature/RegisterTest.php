<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use WithFaker;

    public function testRegisterPage()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('auths.register');
    }

    public function testRegisterPageValidCredentials()
    {
        $name = $this->faker->name;
        $email = 'testing@student.newinti.edu.my';
        $student_id = $this->faker->bothify('P????????');
        $ic_number = $this->faker->numerify('######-##-####');
        $phone_number = $this->faker->numerify('##########');

        $response = $this->post(route('register'), [
            'name' => $name,
            'email' => $email,
            'student_id' => $student_id,
            'ic_number' => $ic_number,
            'phone_number' => $phone_number,
            'password' => 'adminadminadminadmin',
            'password_confirmation' => 'adminadminadminadmin',
        ]);

        $response->assertStatus(302);
    }

    public function testLoginPageInvalidCredentials()
    {
        $response = $this->post(route('register'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email', 'student_id', 'ic_number', 'phone_number', 'password']);
    }
}
