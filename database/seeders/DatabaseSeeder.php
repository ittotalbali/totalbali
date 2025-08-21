<?php

namespace Database\Seeders;

use Database\Seeders\AlbumCategory\AlbumCategorySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            // RoleSeeder::class,
            // PermissionTableSeeder:: class,
            // UserSeeder::class,
            // CurrencySeeder::class,
            // ServiceSeeder::class,
            AlbumCategorySeeder::class,
        ]);
    }
}
