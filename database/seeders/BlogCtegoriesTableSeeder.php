<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCtegoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $cName = 'Without Category';

        $categories[] = [
            'title'     => $cName,
            'slug'      => Str::slug($cName, '-'),
            'parent_id' => 0
        ];

        for($i = 0; $i <= 10; $i++) {
            $cName = 'Category #' . $i;
            $parentId = $i > 4 ? rand(1, 4) : 1;

            $categories[] = [
                'title'     => $cName,
                'slug'      => Str::slug($cName, '-'),
                'parent_id' => $parentId
            ];
        }

        \DB::table('blog_categories')->insert($categories);
    }
}
