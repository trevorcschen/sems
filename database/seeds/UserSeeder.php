<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'student_id' => 'P18213457',
            'ic_number' => '981214-07-5218',
            'phone_number' => '0134578845',
            'biography' => 'I love you :)',
            'profile_image_path' => null,
            'password' => Hash::make('adminadminadminadmin'),
            'active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'cadmin',
            'email' => 'cadmin@admin.com',
            'student_id' => 'P18213451',
            'ic_number' => '981214-07-5211',
            'phone_number' => '0134578841',
            'biography' => 'I love you :)',
            'profile_image_path' => null,
            'password' => Hash::make('adminadminadminadmin'),
            'active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'student',
            'email' => 'student@admin.com',
            'student_id' => 'P18213452',
            'ic_number' => '981214-07-5212',
            'phone_number' => '0134578842',
            'biography' => 'I love you :)',
            'profile_image_path' => null,
            'password' => Hash::make('adminadminadminadmin'),
            'active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
