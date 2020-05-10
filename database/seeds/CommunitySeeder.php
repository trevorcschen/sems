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
        Community::create([
            'name' => 'Computer Science Society',
            'description' => 'Computer Science Society is a fun society',
            'fee' => 25.60,
            'max_members' => 250,
            'logo_path' => null,
            'active' => true,
            'user_id' => 2,
        ]);
    }
}
