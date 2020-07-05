<?php

use App\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Venue::create([
            'name' => 'Computer Lab',
            'description' => 'Computer Lab has a large place to carry ouy activities.',
            'capacity' => 300,
            'air_conditioned' => true,
            'active' => true,
            'venue_image_path' => null,
        ]);

        for ($x = 0; $x <= 20; $x++) {
            factory(Venue::class)->create();
        }
    }
}
