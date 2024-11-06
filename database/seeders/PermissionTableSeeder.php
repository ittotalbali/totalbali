<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'villa-list',
            'villa-create',
            'villa-edit',
            'villa-delete',
            'booking-list',
            'booking-create',
            'booking-edit',
            'booking-delete',
            'rate-list',
            'rate-create',
            'rate-edit',
            'rate-delete',
            'faciliti-list',
            'faciliti-create',
            'faciliti-edit',
            'faciliti-delete',
            'country-list',
            'country-create',
            'country-edit',
            'country-delete',
            'area-list',
            'area-create',
            'area-edit',
            'area-delete',                 
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
