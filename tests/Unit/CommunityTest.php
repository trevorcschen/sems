<?php

namespace Tests\Unit;

use App\Community;
use App\User;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    public function testCommunityCreation()
    {
        $community = factory(Community::class)->create();
        $this->assertInstanceOf(Community::class, $community);
        $this->assertIsString($community->name);
        $this->assertIsString($community->description);
        $this->assertIsInt($community->max_members);
        $this->assertNull($community->logo_path);
        $this->assertIsBool($community->active);

        $this->assertInstanceOf(User::class, $community->admin);
    }
}
