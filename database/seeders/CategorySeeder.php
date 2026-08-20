<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development',  'slug' => 'web-development'],
            ['name' => 'UI/UX Design',     'slug' => 'ui-ux-design'],
            ['name' => 'Mobile App',       'slug' => 'mobile-app'],
            ['name' => 'Open Source',      'slug' => 'open-source'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
