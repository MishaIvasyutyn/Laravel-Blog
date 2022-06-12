<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;


    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(4);
        $slug = Str::slug($title);
        $category=Category::count() >= 7 ? Category::inRandomOrder()->first()->id: Category::factory();
        $thumbnail = $this->faker->image("storage/app/public/images/faker",640,480, null, true);
        return [
            'title' => $title,
            'slug' =>   $slug,
            'description' => $this->faker->text(),
            'content' => $this->faker->paragraph('8'),
            'views' => $this->faker->randomNumber(),
            'thumbnail' => $thumbnail,
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 years', 'now'),

            'category_id' => $category,
        ];
    }
}
