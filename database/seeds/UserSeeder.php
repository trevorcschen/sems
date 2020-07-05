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
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'student_id' => 'P18213457',
            'ic_number' => '981214-07-5218',
            'phone_number' => '0134578845',
            'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec ex ac tortor volutpat tempor. Duis tristique orci a diam auctor, vitae commodo lacus viverra. Mauris sed ultrices nunc. Etiam amet',
            'profile_image_path' => null,
            'password' => Hash::make('adminadminadminadmin'),
            'active' => true,
            'email_verified_at' => now(),
        ]);

        $user->syncRoles('super-admin');

        $user = User::create([
            'name' => 'cadmin',
            'email' => 'cadmin@admin.com',
            'student_id' => 'P18213451',
            'ic_number' => '981214-07-5211',
            'phone_number' => '0134578841',
            'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec ex ac tortor volutpat tempor. Duis tristique orci a diam auctor, vitae commodo lacus viverra. Mauris sed ultrices nunc. Etiam amet',
            'profile_image_path' => null,
            'password' => Hash::make('adminadminadminadmin'),
            'active' => true,
            'email_verified_at' => now(),
        ]);

        $user->syncRoles('community-admin');

        $user = User::create([
            'name' => 'student',
            'email' => 'student@admin.com',
            'student_id' => 'P18213452',
            'ic_number' => '981214-07-5212',
            'phone_number' => '0134578842',
            'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec ex ac tortor volutpat tempor. Duis tristique orci a diam auctor, vitae commodo lacus viverra. Mauris sed ultrices nunc. Etiam amet',
            'profile_image_path' => null,
            'password' => Hash::make('adminadminadminadmin'),
            'active' => true,
            'email_verified_at' => now(),
        ]);

        $user->syncRoles('student');

        for ($x = 0; $x <= 20; $x++) {
            $user = factory(User::class)->create();
            $user->syncRoles('super-admin');
        }

        for ($x = 0; $x <= 20; $x++) {
            $user = factory(User::class)->create();
            $user->syncRoles('community-admin');
        }

        for ($x = 0; $x <= 100; $x++) {
            $user = factory(User::class)->create();
            $user->syncRoles('student');
        }
    }
}
