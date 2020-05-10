<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super-admin',
            'community-admin',
            'student',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $communityAdminRole = Role::findByName('community-admin');
        $communityAdminRole->syncPermissions(
            'user.show',
            'community.show',
            'community.edit',
            'event.create',
            'event.show',
            'event.edit',
            'event.delete',
            'event.join',
            'venue.show');

        $studentRole = Role::findByName('student');
        $studentRole->syncPermissions(
            'user.show',
            'community.show',
            'event.create',
            'event.show',
            'event.edit',
            'event.delete',
            'event.join',
            'venue.show');
    }
}
