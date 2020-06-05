<?php

namespace Tests\Unit;

use App\Venue;
use Tests\TestCase;

class VenueTest extends TestCase
{
    public function testVenueCreation()
    {
        $venue = factory(Venue::class)->create();
        $this->assertInstanceOf(Venue::class, $venue);
        $this->assertIsString( $venue->name);
        $this->assertIsString($venue->description);
        $this->assertIsNumeric($venue->capacity);
        $this->assertIsBool($venue->air_conditioned);
        $this->assertIsBool($venue->active);
        $this->assertNull($venue->venue_image_path);
    }
}
