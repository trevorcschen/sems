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
            'user.create',
            'user.show',
            'user.index',
            'user.edit',
            'user.delete',
            'community.create',
            'community.show',
            'community.index',
            'community.edit',
            'community.delete',
            'event.create',
            'event.show',
            'event.index',
            'event.edit',
            'event.delete',
            'event.join',
            'venue.create',
            'venue.show',
            'venue.index',
            'venue.edit',
            'venue.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
