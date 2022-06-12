<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Post::factory(10)->create();
        \App\Models\Post::all()->each(function ($post) {
            $post->tags()->sync(\App\Models\Tag::all()->random(rand(1, 3)));
        });
    }
}
