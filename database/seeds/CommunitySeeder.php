<?php

use App\Community;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $community = Community::create([
            'name' => 'Computer Science Society',
            'description' => 'Computer Science Society is a fun society',
            'fee' => 25.60,
            'max_members' => 250,
            'logo_path' => null,
            'active' => true,
            'user_id' => 2,
        ]);

//        $community->users()->attach(3); // student

        factory(Community::class, 10)->create([
            'active' => true,
            'user_id' => 2,
        ])->each(function ($community) {
            $community->users()->attach(3); // student
        });

        for ($x = 0; $x <= 30; $x++) {
            factory(Community::class)->create();
        }
    }
}
