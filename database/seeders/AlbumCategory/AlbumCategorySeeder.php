<?php

namespace Database\Seeders\AlbumCategory;

use App\Services\AlbumCategory\StoreAlbumCategoryService;
use Illuminate\Database\Seeder;

class AlbumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Category 1',
            'Category 2',
            'Category 3',
        ];

        foreach($categories as $category) {
            (new StoreAlbumCategoryService)->execute([
                'name' => $category,
            ]);
        }
    }
}
