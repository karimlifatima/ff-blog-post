<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(10)->create();

        Post::all()->each(function ($post) {
            $post->categories()->attach(Category::all()->random(rand(1,3)));
        });
    }
}
