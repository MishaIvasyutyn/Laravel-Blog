<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        $slug= Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
