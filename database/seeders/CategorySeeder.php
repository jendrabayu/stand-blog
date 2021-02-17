<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Nature Lifestyle', 'Awesome Layouts', 'Creative Ideas'];

        foreach ($categories as $category) {
            Category::create([
                'title' => $category,
                'slug' => Str::slug($category) . '-' . (Category::getLatestId() + 1)
            ]);
        }
    }
}
