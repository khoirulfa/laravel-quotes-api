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
        $categories = [
            [
                // 'uuid' => Str::uuid(),
                'title' => 'Life',
                'slug' => 'life',
            ],
            [
                // 'uuid' => Str::uuid(),
                'title' => 'Knowledge',
                'slug' => 'knowledge',
            ],
            [
                // 'uuid' => Str::uuid(),
                'title' => 'Love',
                'slug' => 'love',
            ],
            [
                // 'uuid' => Str::uuid(),
                'title' => 'Inspiration',
                'slug' => 'inspiration',
            ],
            [
                // 'uuid' => Str::uuid(),
                'title' => 'Education',
                'slug' => 'education',
            ],
        ];

        foreach ($categories as $category) {
            $isCategoryExist = Category::where('slug', $category['slug'])->first();
            if (!$isCategoryExist) {
                Category::create([
                    // 'uuid' => $category['uuid'],
                    'title' => $category['title'],
                    'slug' => $category['slug'],
                ]);
            }
        }
    }
}
