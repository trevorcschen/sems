<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'permission.create',
            'permission.show',
            'permission.edit',
            'permission.delete',
            'role.create',
            'role.show',
            'role.edit',
            'role.delete',
            'user.create',
            'user.show',
            'user.edit',
            'user.delete',
            'community.create',
            'community.show',
            'community.edit',
            'community.delete',
            'event.create',
            'event.show',
            'event.edit',
            'event.delete',
            'event.join',
            'venue.create',
            'venue.show',
            'venue.edit',
            'venue.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
