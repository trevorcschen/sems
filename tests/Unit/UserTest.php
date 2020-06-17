<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation()
    {
        $user = factory(User::class)->create();
        $this->assertInstanceOf(User::class, $user);
        $this->assertIsString($user->name);
        $this->assertRegExp('/^.+\@\S+\.\S+$/', $user->email);
        $this->assertStringStartsWith('P', $user->student_id);
        $this->assertIsString($user->ic_number);
        $this->assertIsString('P', $user->phone_number);
        $this->assertIsString('P', $user->biography);
        $this->assertNull( $user->profile_image_path);
        $this->assertIsString($user->password);
        $this->assertIsBool($user->active);
        $this->assertIsString($user->remember_token);
    }
}
