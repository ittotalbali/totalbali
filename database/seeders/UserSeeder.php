<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'image' => 'profile.png',
            'email' => 'admin@totalbali.com',
            'no_hp' => '55556667798',
            'password' => Hash::make('admintotalbali@12345'),
            'role' => 'admin',
            'email_verified_at' => date('Y-m-d'),
            'token' => '12345'
        ]);
        
        $admin_role = Role::create([
            'name' => 'admin'
        ]);
        
        
        $admin_pr = Permission::pluck('id', 'id')->all();
        $admin_role->syncPermissions($admin_pr);
        $admin->assignRole([$admin_role->id]);
        
        $super_admin = User::create([
            'name' => 'super admin',
            'image' => 'profile.png',
            'email' => 'super_admin@totalbali.com',
            'no_hp' => '55556667798',
            'password' => Hash::make('superadmintotalbali@12345'),
            'role' => 'super_admin',
            'email_verified_at' => date('Y-m-d'),
            'token' => '12345'
        ]);
        
        $super_admin_role = Role::create([
            'name' => 'super_admin'
        ]);        
        $super_admin_pr = Permission::pluck('id', 'id')->all();       
        $super_admin_role->syncPermissions($super_admin_pr);
        $super_admin->assignRole([$super_admin->id]);


        User::create([
            'name' => 'owner',
            'image' => 'profile.png',
            'email' => 'owner@totalbali.com',
            'no_hp' => '55556667798',
            'password' => Hash::make('ownertotalbali@12345'),
            'role' => '',
            'email_verified_at' => date('Y-m-d'),
            'token' => '12345'
        ]);
        Role::create([
            'name' => 'owner'
        ]);

        User::create([
            'name' => 'manager',
            'image' => 'profile.png',
            'email' => 'manager@totalbali.com',
            'no_hp' => '55556667798',
            'password' => Hash::make('managertotalbali@12345'),
            'role' => '',
            'email_verified_at' => date('Y-m-d'),
            'token' => '12345'
        ]);
        Role::create([
            'name' => 'manager'
        ]);
    }
}
