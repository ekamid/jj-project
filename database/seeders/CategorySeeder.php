<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'  => 'Global',
            'slug'  => 'global',
            'parent_id' => null,
            'description' => 'This is a default category',
            'banner' => null,
            'published' => true,

        ]);
        Category::create([
            'name'  => 'Nose Pin',
            'slug'  => 'nose-pin',
            'parent_id' => null,
            'description' => 'This is a description',
            'banner' => '/banner/1675144004.png',
            'published' => true,

        ]);
    }
}
